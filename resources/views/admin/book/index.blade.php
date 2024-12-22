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
