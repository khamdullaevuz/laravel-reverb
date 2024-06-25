<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <form wire:submit="create">
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" wire:model="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button type="submit" class="ms-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-2">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Created at
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($chats as $chat)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6">
                                    {{$chat->id}}
                                </th>
                                <th scope="row" class="py-4 px-6">
                                    {{$chat->name}}
                                </th>
                                <td class="py-4 px-6">
                                    {{$chat->created_at}}
                                </td>
                                <td class="py-4 px-6">
                                    @if(!$chat->is_joined)
                                        <x-button wire:click="join({{$chat->id}})" class="ms-4">
                                            {{ __('Join') }}
                                        </x-button>
                                    @else
                                        <x-button wire:click="show({{$chat->id}})" class="ms-4">
                                            {{ __('Show') }}
                                        </x-button>
                                        <x-button wire:click="leave({{$chat->id}})" class="ms-4">
                                            {{ __('Leave') }}
                                        </x-button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
