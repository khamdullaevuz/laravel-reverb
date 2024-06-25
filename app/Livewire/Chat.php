<?php

namespace App\Livewire;

use App\Models\Chat as ChatModel;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Chat extends Component
{
    public Collection $chats;
    public string $name = '';

    public function mount(): void
    {
        $this->chats = ChatModel::all();
        $this->chats->map(function ($chat) {
            $chat->is_joined = $chat->users->contains(auth()->user()->id);
        });
    }

    public function create()
    {
        $chat = new ChatModel();
        $chat->name = $this->name;
        $chat->save();

        return redirect()->route('chats');
    }

    public function join($id)
    {
        $user = auth()->user();
        $user->chats()->attach($id);

        return redirect()->route('chats');
    }

    public function leave($id)
    {
        $user = auth()->user();
        $user->chats()->detach($id);

        return redirect()->route('chats');
    }

    public function show($id)
    {
        return redirect()->route('chats.show', $id);
    }

    public function render(): View
    {
        return view('components.chat');
    }
}
