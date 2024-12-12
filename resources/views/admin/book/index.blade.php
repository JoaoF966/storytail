<div x-data="{ showModal: false, author: {}, url: null, action: '', method: 'post' }">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books') }}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-end">
                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="action = 'Create'; author= {}; url='{{ route('admin.author.create') }}'; method='post'; $dispatch('open-modal', 'author-form-modal')"
                    >{{ __('Create Book') }}</x-primary-button>
                </div>
            </div>
        </div>
    </x-app-layout>

</div>
