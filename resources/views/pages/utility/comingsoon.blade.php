<x-app-layout background="bg-white">
    <main class="grid -mt-16 h-screen place-items-center bg-white">
        <div class="text-center">
          <p class="text-base font-semibold text-indigo-600">Sorry, this feature isn't available yet</p>
          <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Coming Soon!</h1>
          <p class="mt-6 max-w-lg text-base leading-7 text-gray-600">This feature is under construction. We're working hard to improve our
            website and we'll ready to launch after.</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{route('dashboard')}}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go back Dashboard</a>
          </div>
        </div>
      </main>
</x-app-layout>
