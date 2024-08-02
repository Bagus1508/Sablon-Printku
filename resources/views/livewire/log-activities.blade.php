<div class="p-4 sm:p-6 lg:p-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Log Activities</h1>
        </div>
    </div>
    <div class="mt-3 h-[500px] flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Activity
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:bg-boxdark">
                        @foreach ($logs as $log)
                            <tr>
                                <td class="px-2 max-w-max py-1.5 text-sm sm:pl-0">
                                    <div class="font-medium text-gray-900">{{ $log->user }}</div>
                                    <div
                                        class="mt-1 {{ $log->status === 'Error' ? 'text-rose-500' : 'text-gray-500' }}">
                                        {{-- {{ Str::words(Str::title($log->message), 7, '...') }} --}}
                                        {{$log->message}}
                                    </div>
                                    <div>
                                        {{$log->created_at}}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-2 py-1.5 text-sm text-gray-500">
                                    @if ($log->status === 'Error')
                                        <span
                                            class="inline-flex items-center rounded-md bg-rose-50 px-2 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-600/20">Error</span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Success</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $logs->links('vendor.livewire.simple-tailwind') }}
</div>
