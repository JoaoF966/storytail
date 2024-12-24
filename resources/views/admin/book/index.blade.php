<div x-data="{ showModal: false, book: {}, url: null, action: '', method: 'post', imagePreview: null }">
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
                        x-on:click.prevent="action = 'Create'; book= {}; url='{{ route('admin.book.create') }}'; method='post'; $dispatch('open-modal', 'book-form-modal')"
                    >{{ __('Create Book') }}</x-primary-button>

                    <x-modal name="book-form-modal" :show="$errors->isNotEmpty()" focusable>
                        <form method="post" :action="url" class="p-6" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" x-model="method">
                            <h2 class="text-lg font-medium text-gray-900">
                                <span x-text="action"></span>
                                {{ __('Book') }}
                            </h2>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="title" name="title" type="text"
                                              class="mt-1 block w-full" required
                                              autofocus x-model="book.title"
                                              autocomplete="title"/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="description" :value="__('Description')"/>
                                <textarea id="description" name="description" rows="4" x-model="book.description"
                                          class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                            </div>

                            <div class="grid md:grid-cols-3 md:gap-6 mt-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-input-label for="read_time" :value="__('Read time')"/>
                                    <x-text-input id="read_time" name="read_time" type="number"
                                                  class="mt-1 block w-full" required
                                                  autofocus x-model="book.read_time"
                                                  autocomplete="read_time"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('read_time')"/>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-input-label for="age_group" :value="__('Age group')"/>
                                    <x-select name="age_group" id="age_group" autocomplete="off">
                                        @foreach ($ageGroups as $ageGroup)
                                            <option value="{{ $ageGroup->id }}">
                                                {{ $ageGroup->age_group }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error class="mt-2" :messages="$errors->get('age_group')"/>
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <x-input-label for="access_level" :value="__('Access Level')"/>
                                    <x-select id="access_level" name="access_level" type="text"
                                              class="mt-1 block w-full"
                                              required x-model="book.access_level"
                                              autocomplete="access_level">
                                        <option value="free">Free</option>
                                        <option value="Premium">Premium</option>
                                    </x-select>
                                    <x-input-error class="mt-2" :messages="$errors->get('access_level')"/>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="video_book_url" :value="__('Link to video book')"/>
                                <x-text-input id="video_book_url" name="video_book_url" type="text"
                                              class="mt-1 block w-full" placeholder="https://www.youtube.com/watch?v=l5WgAr4B8Vo"
                                              autofocus x-model="book.video_book_url"/>
                                <x-input-error class="mt-2" :messages="$errors->get('video_book_url')"/>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="book_file" :value="__('Book file')"/>
                                <span x-show="book.book_file_path" class="block font-medium text-sm text-gray-400">
                                    Already exist, but you can upload a new one
                                </span>
                                <x-text-input type="file" id="book_file" name="book_file" accept="application/pdf"
                                              class="mt-1 block w-full" autocomplete="off"/>
                                <x-input-error class="mt-2" :messages="$errors->get('book_file')"/>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="cover_image" :value="__('Cover Image')"/>
                                <span x-show="book.cover_url" class="block font-medium text-sm text-gray-400">
                                    Already exist, but you can upload a new one
                                </span>
                                <x-text-input type="file" id="cover_image" name="cover_image" accept="image/*"
                                              class="mt-1 block w-full" autocomplete="off"
                                              @change="let file = $event.target.files[0]; if (file) { imagePreview = URL.createObjectURL(file); }"/>
                                <x-input-error class="mt-2" :messages="$errors->get('cover_image')"/>
                                <div x-show="imagePreview" class="mt-2">
                                    <img :src="imagePreview" alt="Image Preview" class="w-32 h-32 object-cover">
                                </div>
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
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Authors</th>
                            <th class="px-4 py-2 text-left">Is active</th>
                            <th class="px-4 py-2 text-left">Access level</th>
                            <th class="px-4 py-2 text-left">Is featured</th>
                            <th class="px-4 py-2 text-left">Last updated at</th>
                            <th class="px-4 py-2 text-left"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2">
                                    <img src="{{ $book->cover_url }}" class="w-10 h-10 rounded-full"
                                         alt="book cover">
                                </td>
                                <td class="px-4 py-2">{{ $book->title }}</td>
                                <td class="px-4 py-2">
                                    @foreach($book->authors as $author)
                                        {{ $author->first_name }} {{ $author->last_name }}<br>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2">
                                    @if($book->is_active == 1)
                                        <span
                                            class="inline-block bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">yes</span>
                                    @else
                                        <span
                                            class="inline-block bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">No</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($book->access_level === 'premium')
                                        <span
                                            class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Premium</span>
                                    @else
                                        <span
                                            class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Free</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($book->isFeatured())
                                        <span
                                            class="inline-block bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Yes</span>
                                    @else
                                        <span
                                            class="inline-block bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">No</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    {{ $book->updated_at }}
                                </td>
                                <td class="px-4 py-2 text-end">

                                    <x-primary-button
                                        class="px-2" title="Edit book"
                                        x-on:click.prevent="showModal = true; console.log('{{ json_encode($book->toArray()) }}'); book = JSON.parse('{{ json_encode($book->toArray()) }}'); url = '{{ route('admin.book.edit', ['id' => $book->id]) }}'; action = 'Edit'; method='put'; $dispatch('open-modal', 'book-form-modal')"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                        </svg>
                                    </x-primary-button>
                                    <x-danger-button
                                        title="Delete book"
                                        x-on:click.prevent="url = '{{ route('admin.book.destroy', ['id' => $book->id]) }}';$dispatch('open-modal', 'confirm-author-deletion')"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                        </svg>

                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-app-layout>

</div>
