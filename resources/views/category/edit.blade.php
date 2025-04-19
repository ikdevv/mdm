<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Category') . ' ' . $category->code }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

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

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('category.update', [$category->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">

                            <x-input-label for="code" :value="__('Code')" />

                            <x-text-input id="code" class="mt-1 block w-full" name="code" type="text"
                                placeholder="{{ $category->code }} " value="{{ $category->code }}" disabled />

                        </div>
                        <div class="mt-4">

                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="mt-1 block w-full" name="name" type="text"
                                value="{{ $category->name }}" />

                        </div>
                        <div class="mt-4">

                            <x-input-label for="status" :value="__('Status')" />

                            <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                                <option value="active" {{ $category->status === 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $category->status === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                        </div>

                        <x-primary-button class='mt-4' type="submit">
                            {{ __('Update') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
