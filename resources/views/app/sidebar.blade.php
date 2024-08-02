<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="/">
            <img src="{{ asset('src/images/logo/logo.png') }}" alt="Logo" />
        </a>

        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill="" />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6" x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU UMUM</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 @if (Route::is('dashboard.index')) {{ '!bg-graydark dark:bg-meta-4' }} @endif"
                            href="/">
                            <svg width="18" height="18" viewBox="0 0 24 24" class="fill-current"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 12C12 11.4477 12.4477 11 13 11H19C19.5523 11 20 11.4477 20 12V19C20 19.5523 19.5523 20 19 20H13C12.4477 20 12 19.5523 12 19V12Z"
                                    stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M4 5C4 4.44772 4.44772 4 5 4H8C8.55228 4 9 4.44772 9 5V19C9 19.5523 8.55228 20 8 20H5C4.44772 20 4 19.5523 4 19V5Z"
                                    stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M12 5C12 4.44772 12.4477 4 13 4H19C19.5523 4 20 4.44772 20 5V7C20 7.55228 19.5523 8 19 8H13C12.4477 8 12 7.55228 12 7V5Z"
                                    stroke-width="2" stroke-linecap="round" />
                            </svg>

                            Dashboard
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->
                        <!-- Menu Item Data Master -->
                        @if ((in_array($loggedInUser->id_level_user, [1,2])))
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#" @click.prevent="selected = (selected === 'Master' ? '':'Master')">
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                    data-name="Layer 1" width="18" height="18" viewBox="0 0 24 24">
                                    <path
                                        d="M21,7.5c0,.276-.224,.5-.5,.5h-3c-.276,0-.5-.224-.5-.5s.224-.5,.5-.5h3c.276,0,.5,.224,.5,.5Zm-.5,2.5h-3c-.276,0-.5,.224-.5,.5s.224,.5,.5,.5h3c.276,0,.5-.224,.5-.5s-.224-.5-.5-.5Zm0,3h-3c-.276,0-.5,.224-.5,.5s.224,.5,.5,.5h3c.276,0,.5-.224,.5-.5s-.224-.5-.5-.5Zm0,3h-3c-.276,0-.5,.224-.5,.5s.224,.5,.5,.5h3c.276,0,.5-.224,.5-.5s-.224-.5-.5-.5Zm3.5-8.5v9c0,2.481-2.019,4.5-4.5,4.5H4.5c-2.481,0-4.5-2.019-4.5-4.5V7.5C0,5.019,2.019,3,4.5,3h15c2.481,0,4.5,2.019,4.5,4.5Zm-1,0c0-1.93-1.57-3.5-3.5-3.5H4.5c-1.93,0-3.5,1.57-3.5,3.5v9c0,1.93,1.57,3.5,3.5,3.5h15c1.93,0,3.5-1.57,3.5-3.5V7.5Zm-8,4.5c0,3.309-2.691,6-6,6s-6-2.691-6-6,2.691-6,6-6,6,2.691,6,6Zm-6,5c1.198,0,2.284-.441,3.146-1.146l-3.207-3.207c-.283-.283-.439-.66-.439-1.061V7.051c-2.52,.255-4.5,2.364-4.5,4.949,0,2.757,2.243,5,5,5Zm5-5c0-2.586-1.98-4.694-4.5-4.949v4.535c0,.131,.054,.26,.146,.354l3.207,3.207c.706-.862,1.147-1.948,1.147-3.147Z" />
                                </svg>

                                Data Master

                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': (selected === 'Master') }" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                        fill="" />
                                </svg>
                            </a>

                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden"
                                :class="(selected === 'Master') ? 'block' : 'hidden'">
                                <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                    
                                @if ($loggedInUser->id_level_user == 1)
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('data-akun.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                            href="{{ route('data-akun.index') }}"
                                            :class="page === 'akun' && '!text-white'">Data Akun
                                        </a>
                                    </li>
                                @endif
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('data-satuan.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                            href="{{ route('data-satuan.index') }}"
                                            :class="page === 'satuan' && '!text-white'">Data Satuan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('data-ukuran.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                            href="{{ route('data-ukuran.index') }}"
                                            :class="page === 'ukuran' && '!text-white'">Data Ukuran
                                        </a>
                                    </li>
                                    <li>
                                        <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('data-warna.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                            href="{{ route('data-warna.index') }}"
                                            :class="page === 'warna' && '!text-white'">Data Warna
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                        @endif
                        <!-- Menu Item Data Master -->

                        @if ((in_array($loggedInUser->id_level_user, [1,2])))
                        <!-- Menu Item Kategori -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 @if (Route::is('data-kategori.index')) {{ '!bg-graydark dark:bg-meta-4' }} @endif"
                                href="{{ route('data-kategori.index') }}">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z"
                                        fill="" />
                                    <path
                                        d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z"
                                        fill="" />
                                    <path
                                        d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z"
                                        fill="" />
                                    <path
                                        d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z"
                                        fill="" />
                                </svg>

                                Kategori
                            </a>
                        </li>
                        <!-- Menu Item Kategori -->

                        <!-- Menu Item Ekspedisi -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 @if (Route::is('data-ekspedisi.index')) {{ '!bg-graydark dark:bg-meta-4' }} @endif""
                                href="{{ route('data-ekspedisi.index') }}">
                                <svg class="fill-current" width="18" height="20" viewBox="0 0 30 30"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.48 12c-.13.004-.255.058-.347.152l-2.638 2.63-1.625-1.62c-.455-.474-1.19.258-.715.712l1.983 1.978c.197.197.517.197.715 0l2.995-2.987c.33-.32.087-.865-.367-.865zM.5 16h3c.277 0 .5.223.5.5s-.223.5-.5.5h-3c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm0-4h3c.277 0 .5.223.5.5s-.223.5-.5.5h-3c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm0-4h3c.277 0 .5.223.5.5s-.223.5-.5.5h-3C.223 9 0 8.777 0 8.5S.223 8 .5 8zm24 11c-1.375 0-2.5 1.125-2.5 2.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zm-13-1C10.125 19 9 20.125 9 21.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zm-5-14C5.678 6 5 6.678 5 7.5v11c0 .822.678 1.5 1.5 1.5h2c.676.01.676-1.01 0-1h-2c-.286 0-.5-.214-.5-.5v-11c0-.286.214-.5.5-.5h13c.286 0 .5.214.5.5V19h-5.5c-.66 0-.648 1.01 0 1h7c.66 0 .654-1 0-1H21v-9h4.227L29 15.896V18.5c0 .286-.214.5-.5.5h-1c-.654 0-.654 1 0 1h1c.822 0 1.5-.678 1.5-1.5v-2.75c0-.095-.027-.19-.078-.27l-4-6.25c-.092-.143-.25-.23-.422-.23H21V7.5c0-.822-.678-1.5-1.5-1.5z" />
                                </svg>

                                Data Ekspedisi
                            </a>
                        </li>
                        <!-- Menu Item Ekspedisi -->

                        <!-- Menu Item Perusahaan -->
                        <li>
                            <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 @if (Route::is('data-perusahaan.index')) {{ '!bg-graydark dark:bg-meta-4' }} @endif""
                                href="{{ route('data-perusahaan.index') }}">
                                <svg class="fill-current" width="18" height="20" viewBox="0 0 50 50"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path
                                        d="M8 2L8 6L4 6L4 48L46 48L46 14L30 14L30 6L26 6L26 2 Z M 10 4L24 4L24 8L28 8L28 46L19 46L19 39L15 39L15 46L6 46L6 8L10 8 Z M 10 10L10 12L12 12L12 10 Z M 14 10L14 12L16 12L16 10 Z M 18 10L18 12L20 12L20 10 Z M 22 10L22 12L24 12L24 10 Z M 10 15L10 19L12 19L12 15 Z M 14 15L14 19L16 19L16 15 Z M 18 15L18 19L20 19L20 15 Z M 22 15L22 19L24 19L24 15 Z M 30 16L44 16L44 46L30 46 Z M 32 18L32 20L34 20L34 18 Z M 36 18L36 20L38 20L38 18 Z M 40 18L40 20L42 20L42 18 Z M 10 21L10 25L12 25L12 21 Z M 14 21L14 25L16 25L16 21 Z M 18 21L18 25L20 25L20 21 Z M 22 21L22 25L24 25L24 21 Z M 32 22L32 24L34 24L34 22 Z M 36 22L36 24L38 24L38 22 Z M 40 22L40 24L42 24L42 22 Z M 32 26L32 28L34 28L34 26 Z M 36 26L36 28L38 28L38 26 Z M 40 26L40 28L42 28L42 26 Z M 10 27L10 31L12 31L12 27 Z M 14 27L14 31L16 31L16 27 Z M 18 27L18 31L20 31L20 27 Z M 22 27L22 31L24 31L24 27 Z M 32 30L32 32L34 32L34 30 Z M 36 30L36 32L38 32L38 30 Z M 40 30L40 32L42 32L42 30 Z M 10 33L10 37L12 37L12 33 Z M 14 33L14 37L16 37L16 33 Z M 18 33L18 37L20 37L20 33 Z M 22 33L22 37L24 37L24 33 Z M 32 34L32 36L34 36L34 34 Z M 36 34L36 36L38 36L38 34 Z M 40 34L40 36L42 36L42 34 Z M 32 38L32 40L34 40L34 38 Z M 36 38L36 40L38 40L38 38 Z M 40 38L40 40L42 40L42 38 Z M 10 39L10 44L12 44L12 39 Z M 22 39L22 44L24 44L24 39 Z M 32 42L32 44L34 44L34 42 Z M 36 42L36 44L38 44L38 42 Z M 40 42L40 44L42 44L42 42Z" />
                                </svg>

                                Data Perusahaan
                            </a>
                        </li>
                        <!-- Menu Item Perusahaan -->
                        @endif
                </ul>

                {{-- Menu Monitoring Persediaan --}}
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU MONITORING PERSEDIAAN</h3>
                <ul class="flex flex-col gap-1.5">
                    <!-- Menu Item Monitoring Persediaan -->
                    <!-- Menu Item Bahan Baku -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark @if (Route::is(['persediaan-bahan-baku-satuan.index', 'bahan-baku-global.index'])) {{ 'bg-graydark' }} @endif dark:hover:bg-meta-4"
                            href="#" @click.prevent="selected = (selected === 'BahanBaku' ? '':'BahanBaku')">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 24 24"
                                id="_003_ECOMMERCE_03" data-name="003_ECOMMERCE_03"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>003_084</title>
                                <path
                                    d="M20,21H4a.99974.99974,0,0,1-1-1V4A.99974.99974,0,0,1,4,3h9a1,1,0,0,1,0,2H5V19H19V5H17a1,1,0,0,1,0-2h3a.99974.99974,0,0,1,1,1V20A.99974.99974,0,0,1,20,21Z" />
                                <polygon points="10 4 10 11 12 9 14 11 14 4 10 4" />
                            </svg>

                            Bahan Baku

                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'BahanBaku') }" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'BahanBaku') ? 'block' : 'hidden'">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('persediaan-bahan-baku-global.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                        href="{{ route('persediaan-bahan-baku-global.index') }}">Global
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('persediaan-bahan-baku-satuan.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                        href="{{ route('persediaan-bahan-baku-satuan.index') }}">Satuan
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                </ul>

                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Monitoring Persediaan -->
                    <!-- Menu Item Pakaian & Celana -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark @if (Route::is(['persediaan-pakaian-celana-satuan.index', 'pakaian-celana-global.index'])) {{ 'bg-graydark' }} @endif dark:hover:bg-meta-4"
                            href="#"
                            @click.prevent="selected = (selected === 'PakaianDanCelana' ? '':'PakaianDanCelana')">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 32 32"
                                id="svg5" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:svg="http://www.w3.org/2000/svg">

                                <defs id="defs2" />

                                <g id="layer1" transform="translate(-156,-340)">

                                    <path
                                        d="m 169.5,357.01367 a 1,1 0 0 0 -0.70703,0.29297 1,1 0 0 0 0,1.41406 l 5,5 a 1,1 0 0 0 1.41406,0 1,1 0 0 0 0,-1.41406 l -5,-5 A 1,1 0 0 0 169.5,357.01367 Z"
                                        id="path453523" />

                                    <path
                                        d="m 169.5,351.51367 a 1,1 0 0 0 -0.70703,0.29297 1,1 0 0 0 0,1.41406 l 5,5 a 1,1 0 0 0 1.41406,0 1,1 0 0 0 0,-1.41406 l -5,-5 A 1,1 0 0 0 169.5,351.51367 Z"
                                        id="path453515" />

                                    <path
                                        d="m 168.07812,342.01562 a 1.0001,1.0001 0 0 0 -0.48437,0.084 l -9,4 a 1.0001,1.0001 0 0 0 -0.58398,1.05469 l 1,7 a 1.0001,1.0001 0 0 0 1.4375,0.7539 L 163,353.63281 v 15.38086 a 1.0001,1.0001 0 0 0 1,1 h 16 a 1.0001,1.0001 0 0 0 1,-1 v -15.38086 l 2.55273,1.27539 a 1.0001,1.0001 0 0 0 1.4375,-0.7539 l 1,-7 a 1.0001,1.0001 0 0 0 -0.58398,-1.05469 l -9,-4 A 1.0001,1.0001 0 0 0 175,343.01367 c 0,1.6687 -1.3313,3 -3,3 -1.6687,0 -3,-1.3313 -3,-3 a 1.0001,1.0001 0 0 0 -0.92188,-0.99805 z m -0.79101,2.40821 c 0.62208,2.05393 2.46313,3.58984 4.71289,3.58984 2.24976,0 4.09081,-1.53591 4.71289,-3.58984 l 7.18945,3.19531 -0.69726,4.87891 -2.75781,-1.37891 A 1.0001,1.0001 0 0 0 179,352.01367 v 16 h -14 v -16 a 1.0001,1.0001 0 0 0 -1.44727,-0.89453 l -2.75781,1.37891 -0.69726,-4.87891 z"
                                        id="path453497" />

                                </g>

                            </svg>

                            Pakaian & Celana

                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'PakaianDanCelana') }" width="20"
                                height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'PakaianDanCelana') ? 'block' : 'hidden'">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('persediaan-pakaian-celana-global.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                        href="{{ route('persediaan-pakaian-celana-global.index') }}">Global
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('persediaan-pakaian-celana-satuan.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                        href="{{ route('persediaan-pakaian-celana-satuan.index') }}">Satuan
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                </ul>
                {{-- Menu Monitoring Persediaan --}}

                @if ((in_array($loggedInUser->id_level_user, [1,2])))
                {{-- Menu Monitoring Pekerjaan --}}
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU MONITORING PEKERJAAN</h3>
                <ul class="flex flex-col gap-1.5">
                    <!-- Menu Item Monitoring Persediaan -->
                    <!-- Menu Item Bahan Baku -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark @if (Route::is(['persediaan-bahan-baku-satuan.index', 'monitoring-kontrak-global.index'])) {{ 'bg-graydark' }} @endif dark:hover:bg-meta-4"
                            href="#" @click.prevent="selected = (selected === 'Kontrak' ? '':'Kontrak')">
                            <svg width="18" height="18" class="fill-current" viewBox="0 0 1024 1024" class="icon"
                                version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <path d="M182.52 146.2h585.14v256h73.15V73.06H109.38v877.71h256v-73.14H182.52z"
                                     />
                                <path
                                    d="M255.67 219.34h438.86v73.14H255.67zM255.67 365.63h365.71v73.14H255.67zM255.67 511.91H475.1v73.14H255.67zM775.22 458.24L439.04 794.42l-0.52 154.64 155.68 0.52L930.38 613.4 775.22 458.24z m51.72 155.16l-25.43 25.43-51.73-51.72 25.44-25.44 51.72 51.73z m-77.14 77.15L620.58 819.77l-51.72-51.72 129.22-129.22 51.72 51.72zM511.91 876.16l0.17-51.34 5.06-5.06 51.72 51.72-4.85 4.85-52.1-0.17z"
                                     />
                            </svg>

                            Monitoring Kontrak

                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'Kontrak') }" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Kontrak') ? 'block' : 'hidden'">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('monitoring-kontrak-global.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                        href="{{ route('monitoring-kontrak-global.index') }}">Kontrak Global
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('monitoring-kontrak-rinci.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                        href="{{ route('monitoring-kontrak-rinci.index') }}">Kontrak Rinci
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 @if (Route::is('data-region.index')) {{ 'text-white' }} @endif duration-300 ease-in-out hover:text-white"
                                        href="{{ route('data-region.index') }}">Data Region
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                </ul>
                {{-- Menu Monitoring Pekerjaan --}}
                @endif
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
