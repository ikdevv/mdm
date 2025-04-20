<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">All Items</h3>
                        <div>
                            <a href="{{ route('items.export.excel') }}" class="btn btn-success">
                                <x-primary-button>{{ __('Export to Excel') }}</x-primary-button>
                            </a>
                            <a href="{{ route('items.export.csv') }}" class="btn btn-success">
                                <x-primary-button>{{ __('Export to CSV') }}</x-primary-button></a>
                            <a href="{{ route('ites.export.pdf') }}" class="btn btn-danger">
                                <x-primary-button>{{ __('Export to PDF') }}</x-primary-button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <form method="GET" action="#">
                    <x-text-input name="search" placeholder="Search for items....." value="{{ request('search') }}" />
                    <x-primary-button type="submit" class="ml-2">
                        {{ __('Search') }}
                    </x-primary-button>
                </form>

            </div>
            <div class="mt-4 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                @foreach ($items as $item)
                    <div
                        class="transform rounded-lg border border-gray-300 bg-white p-6 shadow-lg transition-transform hover:scale-105 hover:shadow-2xl dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="mb-4 text-2xl font-bold text-gray-900 dark:text-gray-100">Item Name:
                            {{ $item->name }}</h3>
                        <p class="mb-2 text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Brand:</span> {{ $item->brand->name }}
                        </p>
                        <p class="mb-2 text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Category:</span> {{ $item->category->name }}
                        </p>
                        <p class="mb-2 text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Code:</span> {{ $item->code }}
                        </p>

                        <div>
                            <span class="font-semibold">Status:</span>
                            <strong class= '{{ $item->status == 'active' ? 'text-green-600' : 'text-red-500' }}'>
                                {{ $item->status }}
                            </strong>
                        </div>


                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('item.edit', $item->id) }}"
                                class="text-blue-500 hover:text-blue-700">Edit</a>
                            <div>
                                <button onclick="openModal({{ $item->id }})" class="text-red-500">Delete</button>

                                <div id="modal-{{ $item->id }}"
                                    class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black bg-opacity-50">
                                    <div class="rounded bg-white p-6 shadow-lg dark:bg-gray-800">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                            Confirm Deletion</h2>
                                        <p class="mt-2 text-gray-600 dark:text-gray-400">Are you sure you
                                            want to delete this item?</p>
                                        <div class="mt-4 flex justify-end space-x-4">
                                            <button onclick="closeModal({{ $item->id }})"
                                                class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600">Cancel</button>
                                            <form action="{{ route('item.destroy', ['item' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-800">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
