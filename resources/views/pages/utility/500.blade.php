<x-app-layout background="bg-white">
    <main class="grid -mt-16 h-screen place-items-center bg-white dark:bg-slate-800">
        <div class="text-center">
          <p class="text-base font-semibold text-indigo-600">Something Bad Happened :(</p>
          <h1 class="mt-4 text-3xl font-bold tracking-tight text-black dark:text-white sm:text-5xl">Internal Sever Error!</h1>
          <p class="mt-6 text-base leading-7 text-gray-600 dark:text-white">Sorry, we couldn’t process your request.</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{route('dashboard.index')}}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go back Dashboard</a>
          </div>
        </div>
      </main>
</x-app-layout>
