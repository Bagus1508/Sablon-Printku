@props([
    'width' => 'w-1/2',
    'placeholder' => 'Pencarian ...'
])

<div class="sm:{{$width}}  sm:justify-self-end justify-center my-auto">
    <div class="relative my-auto items-end flex ">
        <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
            <kbd class="inline-flex items-center px-1 font-sans text-xs text-gray-400">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </kbd>
        </div>
        <input wire:model.live='search' placeholder="{{$placeholder}}" type="text" name="search" id="search" class="dark:bg-boxdark block w-full rounded-md border-0 py-1.5 px-5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
    </div>
</div>