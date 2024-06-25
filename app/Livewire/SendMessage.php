<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SendMessage extends Component
{
    public string $body = '';
    public $chat;

    public function mount()
    {
        $this->chat = request()->route('id');
    }
    public function sent(): void
    {
        $message = new Message();
        $message->body = $this->body;
        $message->user()->associate(auth()->user());
        $message->chat()->associate($this->chat);
        $message->save();

        $message->load('user');
        $message->load('chat');

        event(new MessageSent($message));
        $this->reset('body');
    }
    public function render(): View
    {
        return view('components.send-message');
    }
}
