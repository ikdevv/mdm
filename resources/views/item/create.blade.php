<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Add An Item') }}
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

                    <form method="POST" action="{{ route('item.store') }}">
                        @csrf

                        {{-- brands --}}

                        <div class="mt-4">

                            <x-input-label for="brand" :value="__('Brand')" />

                            <select name="brand_id" id="brand"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                                @foreach ($brands as $brand)
                                    <option value={{ $brand->id }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        {{-- categories --}}

                        <div class="mt-4">

                            <x-input-label for="category" :value="__('Category')" />

                            <select name="category_id" id="category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mt-4">

                            <x-input-label for="code" :value="__('Code')" />

                            <x-text-input id="code" class="mt-1 block w-full" name="code" type="text" />

                        </div>
                        <div class="mt-4">

                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="mt-1 block w-full" name="name" type="text" />

                        </div>
                        <div class="mt-4">

                            <x-input-label for="status" :value="__('Status')" />

                            <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>

                        </div>

                        <x-primary-button class='mt-4' type="submit">
                            {{ __('Create') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
