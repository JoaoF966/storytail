<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-end">
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-user-form-modal')"
                >{{ __('Create tag') }}</x-primary-button>
                <x-modal name="create-user-form-modal" :show="$errors->tagCreation->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('tag.create') }}" class="p-6">
                        @csrf
                        <div class="mt-6">
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                                          autocomplete="name"/>
                            <x-input-error class="mt-2" :messages="$errors->tagCreation->get('name')"/>
                        </div>


                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-primary-button class="ms-3">
                                {{ __('Create tag') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Created at</th>
                            <th class="px-4 py-2 text-left">Last updated at</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $tag->name }}</td>
                                <td class="px-4 py-2">{{ $tag->created_at }}</td>
                                <td class="px-4 py-2">{{ $tag->updated_at }}</td>
                                <td class="px-4 py-2 text-end">
                                    <x-primary-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'create-user-form-modal')"
                                    >{{ __('edit') }}</x-primary-button>
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                    >{{ __('delete') }}</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
