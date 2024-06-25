<div>
    <form wire:submit="sent">
        <div>
            <x-input id="body" wire:model="body" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autofocus autocomplete="name" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button type="submit" class="ms-4">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
</div>
