<div
  x-show="loaded"
  x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 10) })"
  class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center"
>
  <!-- Background dengan opacity -->
  <div class="absolute left-0 top-0 h-screen w-screen bg-boxdark dark:bg-black opacity-50"></div>
  
  <!-- Spinner -->
  <div class="relative flex flex-row gap-2">
    <div class="w-4 h-4 rounded-full bg-blue-700 animate-bounce"></div>
    <div class="w-4 h-4 rounded-full bg-blue-700 animate-bounce [animation-delay:-.2s]"></div>
    <div class="w-4 h-4 rounded-full bg-blue-700 animate-bounce [animation-delay:-.4s]"></div>
  </div>
</div>




