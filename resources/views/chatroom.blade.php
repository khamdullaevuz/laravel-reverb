<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="clearfix" id="messages">
                @foreach($messages as $message)
                    <div class="mt-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 mx-4 my-2 p-2 rounded-lg">
                        <div class="mt-1 block font-medium text-sm text-gray-700 dark:text-gray-300"><b>{{$message->user->name}}</b></div>
                        <div class="mt-1 block font-medium text-sm text-gray-700 dark:text-gray-300">{{$message->body}}</div>
                        <div class="mt-1 mb-1 text-right block font-medium text-sm text-gray-700 dark:text-gray-300">{{$message->created_at}}</div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 mx-4 my-2 p-2 rounded-lg">
                <livewire:send-message />
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
    <script>
        setTimeout(() => {
            window.Echo.private('chats.{{$chat->id}}')
                .listen('.MessageSent', (e) => {
                    let message = e.message;
                    let messages = document.getElementById('messages');
                    let messageData = `<div class="mt-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 mx-4 my-2 p-2 rounded-lg">
                                            <div class="mt-1 block font-medium text-sm text-gray-700 dark:text-gray-300"><b>${message.user.name}</b></div>
                                            <div class="mt-1 block font-medium text-sm text-gray-700 dark:text-gray-300">${message.body}</div>
                                            <div class="mt-1 mb-1 text-right block font-medium text-sm text-gray-700 dark:text-gray-300">${message.created_at}</div>
                                        </div>`;
                    messages.innerHTML += messageData;
                    messages.scrollTop = messages.scrollHeight;
                });
        }, 200)
    </script>
</x-app-layout>
