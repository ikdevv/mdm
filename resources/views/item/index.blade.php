<x-app-layout>
    <x-slot name="header">
        <div class= 'flex items-center justify-between'>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Items') }}
            </h2>
            <a href={{ route('item.create') }}>
                <div class="float-end">
                    <x-primary-button> {{ __('Add Item') }} </x-primary-button>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div id="success-message" class="bg-green- mb-4 rounded-lg p-4 text-white dark:bg-gray-700">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('success-message').style.display = 'none';
                    }, 5000);
                </script>
            @endif
            @if (session('error'))
                <div id="error-message" class="mb-4 rounded-lg bg-red-400 p-4 text-red-700">
                    {{ session('error') }}
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('error-message').style.display = 'none';
                    }, 5000);
                </script>
            @endif
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    {{ __('Code') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    {{ __('Name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    {{ __('Brand') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    {{ __('Category') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($items as $item)
                                <tr class="cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item->code }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item->name }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item->brand->name }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item->category->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                    @if ($items->isEmpty())
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            No items available.
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                        @foreach ($items as $item)
                            <div
                                class="transform rounded-2xl border border-gray-300 bg-white p-6 shadow-lg transition-transform hover:scale-105 hover:shadow-2xl dark:border-gray-700 dark:bg-gray-800">
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
                                    <strong
                                        class= '{{ $item->status == 'active' ? 'text-green-600' : 'text-red-500' }}'>
                                        {{ $item->status }}
                                    </strong>
                                </div>


                                <div class="mt-4 flex justify-between">
                                    <a href="{{ route('item.edit', $item->id) }}"
                                        class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <div>
                                        <button onclick="openModal({{ $item->id }})"
                                            class="text-red-500">Delete</button>

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
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(`modal-${id}`).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(`modal-${id}`).classList.add('hidden');
        }
    </script>
</x-app-layout>
