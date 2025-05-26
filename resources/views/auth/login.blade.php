<x-authentication-layout>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <!-- ====== Forms Section Start -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex flex-wrap items-center">
                <div class="hidden w-full xl:block xl:w-1/2">
                    <div class="px-26 py-17.5 text-center">
                        <a class="mb-5.5 inline-block" href="#">
                            <img class="hidden dark:block" src="{{ asset('src/images/logo/logo.png') }}" width="200px" alt="Logo" />
                            <img class="dark:hidden" src="{{ asset('src/images/logo/logo.png') }}" width="200px"  alt="Logo" />
                        </a>

                        <p class="font-medium 2xl:px-20">
                            Selamat Datang, semoga harimu menyenangkan.
                        </p>

                        <span class="mt-15 inline-block">
                            <img src="{{ asset('src/images/illustration/illustration-03.svg') }}" alt="illustration" />
                        </span>
                    </div>
                </div>
                <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                    <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                        <span class="mb-1.5 block font-medium">Sablon Print Surabaya</span>
                        <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                            Login ke Dashboard
                        </h2>
                        @if ($errors->any())
                            <div>
                                <ul class="text-red-500">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">Username</label>
                                <div class="relative">
                                    <input type="text" name="email" id="email" placeholder="Masukan Email Anda"
                                        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />

                                    <span class="absolute right-4 top-4">
                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g opacity="0.5">
                                                <path
                                                    d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z"
                                                    fill="" />
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="mb-2.5 block font-medium text-black dark:text-white">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" placeholder="Masukan Password"
                                        class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                    <span class="absolute right-4 top-4">
                                        <button type="button" id="toggle-password">
                                            <svg id="show-icon" class="hidden" width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#808080" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#808080" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <svg id="hide-icon" class="" width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.60997 9.60714C8.05503 10.4549 7 12.1043 7 14C7 16.7614 9.23858 19 12 19C13.8966 19 15.5466 17.944 16.3941 16.3878M21 14C21 9.02944 16.9706 5 12 5C11.5582 5 11.1238 5.03184 10.699 5.09334M3 14C3 11.0069 4.46104 8.35513 6.70883 6.71886M3 3L21 21" stroke="#808080" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-5">
                                <input type="submit" value="Login"
                                    class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Forms Section End -->
    </div>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const showIcon = document.getElementById('show-icon');
            const hideIcon = document.getElementById('hide-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
            showIcon.classList.toggle('hidden');
            hideIcon.classList.toggle('hidden');
        });
    </script>
</x-authentication-layout>
