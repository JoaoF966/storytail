<div x-data="{ showModal: false, author: {}, url: null }">
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
                        x-on:click.prevent="$dispatch('open-modal', 'create-author-form-modal')"
                    >{{ __('Create Author') }}</x-primary-button>
                    <x-modal name="create-author-form-modal" :show="$errors->authorCreation->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('author.create') }}" class="p-6">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Create Author') }}
                            </h2>
                            <div class="grid md:grid-cols-2 md:gap-6 mt-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-input-label for="first_name" :value="__('First Name')"/>
                                    <x-text-input id="first_name" name="first_name" type="text"
                                                  class="mt-1 block w-full" required
                                                  autofocus
                                                  autocomplete="first_name"/>
                                    <x-input-error class="mt-2" :messages="$errors->authorCreation->get('first_name')"/>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-input-label for="last_name" :value="__('Last Name')"/>
                                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                                  required
                                                  autocomplete="last_name"/>
                                    <x-input-error class="mt-2" :messages="$errors->authorCreation->get('last_name')"/>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="description" :value="__('Description')"/>
                                <textarea id="description" name="description" rows="4"
                                          class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->authorCreation->get('description')"/>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="nationality" :value="__('Nationality')"/>
                                <x-text-input id="nationality" name="nationality" type="text"
                                              class="mt-1 block w-full" required
                                              autofocus
                                              autocomplete="nationality"/>
                                <x-input-error class="mt-2" :messages="$errors->authorCreation->get('nationality')"/>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="description" :value="__('Upload file')"/>
                                <input
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    aria-describedby="user_avatar_help" id="user_avatar" type="file">
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

            </div>
        </div>
    </x-app-layout>
</div>
