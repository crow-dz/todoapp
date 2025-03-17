<div class="mb-7">

    <div id="head" class="flex border-blue-800 border-t-2">
        <div class="w-full">
            <header class="flex bg-white justify-between h-20 border-b border-b-gray-200 items-center px-6">
                <div id="left-header" class="">
                </div>
                <div id="right-header" class="text-gray-800 hover:text-gray-600 space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </header>
        </div>
    </div>
    @session('error')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error</strong>
            <span class="block sm:inline">{{ session('error')}}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endsession
    <div id="content" class="mx-auto" style="max-width:500px;">
        <div class="container content py-6 mx-auto">
            <div class="mx-auto">
                @include('livewire.includes.create-todo-box')
            </div>
        </div>
        @include('livewire.includes.search-todo-box')
        <div id="todos-list">

            @foreach ($todos as $todo)
                @include('livewire.includes.todo-card')
            @endforeach
            <div class="my-2">
                {{ $todos->links() }}
            </div>
        </div>
    </div>
</div>
