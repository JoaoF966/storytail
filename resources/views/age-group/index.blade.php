<div x-data="{ showModal: false, ageGroup: '', url: null, action: '', method: 'post' }">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Age groups') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-end">
                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="action = 'Create'; author= {}; url='{{ route('age_group.create') }}'; method='post'; $dispatch('open-modal', 'age-group-form-modal')"
                    >{{ __('Create Age group') }}</x-primary-button>

                    <x-modal name="age-group-form-modal" :show="$errors->isNotEmpty()" focusable>
                        <form method="post" :action="url" class="p-6">
                            @csrf
                            <input type="hidden" name="_method" x-model="method">
                            <h2 class="text-lg font-medium text-gray-900">
                                <span x-text="action"></span>
                                {{ __('Age group') }}
                            </h2>

                            <div class="mt-6">
                                <x-input-label for="age_group" :value="__('Age group')"/>
                                <x-text-input id="age_group" name="age_group" type="text" class="mt-1 block w-full" required
                                              autofocus x-model="ageGroup"
                                              autocomplete="age_group"/>
                                <x-input-error class="mt-2" :messages="$errors->tagCreation->get('age_group')"/>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3" x-text="action">
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Age group</th>
                            <th class="px-4 py-2 text-left">Created at</th>
                            <th class="px-4 py-2 text-left">Last updated at</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ageGroups as $ageGroup)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2">{{ $ageGroup->age_group }}</td>
                                <td class="px-4 py-2">{{ $ageGroup->created_at }}</td>
                                <td class="px-4 py-2">{{ $ageGroup->updated_at }}</td>
                                <td class="px-4 py-2 text-end">
                                    <x-primary-button
                                        x-data=""
                                        x-on:click.prevent="showModal = true; ageGroup = '{{ $ageGroup->age_group }}'; url = '{{ route('age_group.edit', ['id' => $ageGroup->id]) }}'; action = 'Edit'; method='put'; $dispatch('open-modal', 'age-group-form-modal')"
                                    >{{ __('edit') }}</x-primary-button>
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="url = '{{ route('age_group.destroy', ['id' => $ageGroup->id]) }}';$dispatch('open-modal', 'confirm-age-group-deletion')"
                                    >{{ __('delete') }}</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <x-modal name="confirm-age-group-deletion" :show="$errors->ageGroupDeletion->isNotEmpty()" focusable>
                        <form method="post" :action="url" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this Age group?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once this age group is deleted, it will be removed from all books and this action is irreversible!') }}
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
