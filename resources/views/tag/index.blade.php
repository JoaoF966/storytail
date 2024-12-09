<div x-data="{ showModal: false, tagName: '', url: null }">
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
                        x-on:click.prevent="$dispatch('open-modal', 'create-tag-form-modal')"
                    >{{ __('Create tag') }}</x-primary-button>
                    <x-modal name="create-tag-form-modal" :show="$errors->tagCreation->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('tag.create') }}" class="p-6">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Create Tag') }}
                            </h2>

                            <div class="mt-6">
                                <x-input-label for="name" :value="__('Name')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                                              autofocus
                                              autocomplete="name"/>
                                <x-input-error class="mt-2" :messages="$errors->tagCreation->get('name')"/>
                            </div>


                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    {{ __('Create') }}
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
                                        x-on:click.prevent="showModal = true; tagName = '{{ $tag->name }}'; url = '{{ route('tag.edit', ['id' => $tag->id]) }}'; $dispatch('open-modal', 'edit-tag-form-modal')"
                                    >{{ __('edit') }}</x-primary-button>
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="url = '{{ route('tag.destroy', ['id' => $tag->id]) }}';$dispatch('open-modal', 'confirm-tag-deletion')"
                                    >{{ __('delete') }}</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <x-modal name="edit-tag-form-modal" x-show="showModal" focusable>
                        <form method="post" :action="url" class="p-6">
                            @csrf
                            @method('put')
                            <div class="mt-6">
                                <x-input-label for="name" :value="__('Name')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                                              autocomplete="name" x-model="tagName"/>
                                <x-input-error class="mt-2" :messages="$errors->tagEdition->get('name')"/>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="showModal = false; $dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    {{ __('Update tag') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>

                    <x-modal name="confirm-tag-deletion" :show="$errors->tagDeletion->isNotEmpty()" focusable>
                        <form method="post" :action="url" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this tag?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once this tag is deleted, it will be removed from all books and this action is irreversible!') }}
                            </p>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete Tag') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
