<div x-data="{ showModal: false, author: {}, url: null, action: '', method: 'post' }">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books') }}
            </h2>
        </x-slot>
    </x-app-layout>
</div>
