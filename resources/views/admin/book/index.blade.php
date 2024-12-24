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
                                              class="mt-1 block w-full" required placeholder="https://www.youtube.com/watch?v=l5WgAr4B8Vo"
                                              autofocus x-model="book.video_book_url"/>
                                <x-input-error class="mt-2" :messages="$errors->get('video_book_url')"/>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="book_file" :value="__('Book file')"/>
                                <x-text-input type="file" id="book_file" name="book_file" accept="application/pdf"
                                              class="mt-1 block w-full" autocomplete="off"/>
                                <x-input-error class="mt-2" :messages="$errors->get('book_file')"/>
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="cover_image" :value="__('Cover Image')"/>
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
                                    {{ $book->updated_at }}</td>
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
