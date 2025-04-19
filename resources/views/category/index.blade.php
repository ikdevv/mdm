<x-app-layout>
    <x-slot name="header">
        <div class= 'flex items-center justify-between'>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Categories') }}
            </h2>
            <a href={{ route('category.create') }}>
                <div class="float-end">
                    <x-primary-button> {{ __('Create Category') }} </x-primary-button>
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
                <div id="error-message" class="mb-4 rounded-lg bg-red-400 p-4 text-white dark:bg-gray-700">
                    {{ session('error') }}
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('error-message').style.display = 'none';
                    }, 5000);
                </script>
            @endif
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($categories->isEmpty())
                        <div class="text-center text-gray-500 dark:text-gray-400">
                            No Categories available.
                        </div>
                    @endif
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach ($categories as $category)
                            <div class="rounded-lg bg-gray-800 p-4 shadow-md">
                                <div class="flex items-center justify-between">
                                    <div>
                                        {{ $category->code }} | {{ $category->name }}
                                    </div>

                                    <div class="flex items-center">
                                        <div class="p-2">
                                            <a href={{ route('category.edit', ['category' => $category->id]) }}>
                                                Edit
                                            </a>
                                        </div>


                                        <div>
                                            <button onclick="openModal({{ $category->id }})"
                                                class="text-red-500">Delete</button>

                                            <div id="modal-{{ $category->id }}"
                                                class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black bg-opacity-50">
                                                <div class="rounded bg-white p-6 shadow-lg dark:bg-gray-800">
                                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                        Confirm Deletion</h2>
                                                    <p class="mt-2 text-gray-600 dark:text-gray-400">Are you
                                                        sure you
                                                        want to delete this Category?</p>
                                                    <div class="mt-4 flex justify-end space-x-4">
                                                        <button onclick="closeModal({{ $category->id }})"
                                                            class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600">Cancel</button>
                                                        <form
                                                            action="{{ route('category.destroy', ['category' => $category->id]) }}"
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
                                <div>
                                    <strong
                                        class= '{{ $category->status == 'active' ? 'text-green-600' : 'text-red-500' }}'>
                                        status : {{ $category->status }}
                                    </strong>
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
