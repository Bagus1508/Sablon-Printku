<x-app-layout background="bg-white">
    <main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-48 lg:px-8">
        <div class="text-center">
          <p class="text-base font-semibold text-indigo-600">Error Code 503</p>
          <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Service Unavailable!</h1>
          <p class="mt-6 text-base leading-7 text-gray-600">Sorry, we couldn’t process your request.</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ URL::previous() }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go back</a>
            <a href="https://api.whatsapp.com/send?phone=6285962324219&text=Permisi%20mas%20restu%20ada%20error%20di%20website%20sotopanaz
            " class="text-sm font-semibold text-gray-900 rounded-md border border-solid px-3.5 py-2.5 hover:bg-gray-100 animate-pulse hover:animate-none border-gray-300"> <span class="" aria-hidden="true">Contact support &nbsp; &rarr;</span></a>
          </div>
        </div>
      </main>
</x-app-layout>
