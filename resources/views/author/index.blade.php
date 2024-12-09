<div x-data="{ showModal: false, author: {}, url: null, action: '', method: 'post' }">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Authors') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-end">
                    <x-primary-button
                            x-data=""
                            x-on:click.prevent="action = 'Create'; author= {}; url='{{ route('author.create') }}'; method='post'; $dispatch('open-modal', 'author-form-modal')"
                    >{{ __('Create Author') }}</x-primary-button>
                    <x-modal name="author-form-modal" :show="$errors->isNotEmpty()" focusable>
                        <form method="post" :action="url" class="p-6">
                            @csrf
                            <input type="hidden" name="_method" x-model="method">
                            <h2 class="text-lg font-medium text-gray-900">
                                <span x-text="action"></span>
                                {{ __('Author') }}
                            </h2>
                            <div class="grid md:grid-cols-2 md:gap-6 mt-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-input-label for="first_name" :value="__('First Name')"/>
                                    <x-text-input id="first_name" name="first_name" type="text"
                                                  class="mt-1 block w-full" required
                                                  autofocus x-model="author.first_name"
                                                  autocomplete="first_name"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-input-label for="last_name" :value="__('Last Name')"/>
                                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                                  required x-model="author.last_name"
                                                  autocomplete="last_name"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="description" :value="__('Description')"/>
                                <textarea id="description" name="description" rows="4" x-model="author.description"
                                          class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="nationality" :value="__('Nationality')"/>
                                <x-text-input id="nationality" name="nationality" type="text"
                                              class="mt-1 block w-full" required
                                              autofocus x-model="author.nationality"
                                              autocomplete="nationality"/>
                                <x-input-error class="mt-2" :messages="$errors->get('nationality')"/>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3" x-text="action"></x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left"></th>
                            <th class="px-4 py-2 text-left">First name</th>
                            <th class="px-4 py-2 text-left">Last name</th>
                            <th class="px-4 py-2 text-left">Nationality</th>
                            <th class="px-4 py-2 text-left">Created at</th>
                            <th class="px-4 py-2 text-left">Last updated at</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($authors as $author)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2">
                                    <img src="{{ $author->author_photo_url }}" class="w-10 h-10 rounded-full"
                                         alt="author avatar">
                                </td>
                                <td class="px-4 py-2">{{ $author->first_name }}</td>
                                <td class="px-4 py-2">{{ $author->last_name }}</td>
                                <td class="px-4 py-2">{{ $author->nationality }}</td>
                                <td class="px-4 py-2">{{ $author->created_at }}</td>
                                <td class="px-4 py-2">{{ $author->updated_at }}</td>
                                <td class="px-4 py-2 text-end">
                                    <x-primary-button
                                        x-data=""
                                        x-on:click.prevent="showModal = true; author = JSON.parse('{{ json_encode($author->toArray()) }}'); url = '{{ route('author.edit', ['id' => $author->id]) }}'; action = 'Edit'; method='put'; $dispatch('open-modal', 'author-form-modal')"
                                    >{{ __('edit') }}</x-primary-button>
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="url = '{{ route('author.destroy', ['id' => $author->id]) }}';$dispatch('open-modal', 'confirm-author-deletion')"
                                    >{{ __('delete') }}</x-danger-button>
                                </td>
                        @endforeach
                        </tbody>
                    </table>

                    <x-modal name="confirm-author-deletion" :show="$errors->tagDeletion->isNotEmpty()" focusable>
                        <form method="post" :action="url" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this author?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once this author is deleted, it will be removed from all books and this action is irreversible!') }}
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
