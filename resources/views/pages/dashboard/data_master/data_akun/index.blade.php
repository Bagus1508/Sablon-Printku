<x-app-layout>
    @section('title', 'Data Akun')
    <div class="mt-4 md:flex md:items-center md:justify-between mx-10">
        <div class="min-w-0 flex-1">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">Data Bagian Unit Kerja</h2>
        </div>
    </div>
    <div class="mx-auto max-w-screen-2xl p-10 md:p-10 2xl:p-10 -mt-10">
        @livewire('account-table')
    </div>

    @include('pages.dashboard.data_master.data_akun.create')

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordInputs = [document.getElementById('password1'), document.getElementById('password2')];
            var showIcon = document.getElementById('show-icon');
            var hideIcon = document.getElementById('hide-icon');

            passwordInputs.forEach(function(passwordInput) {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });

            showIcon.classList.toggle('hidden');
            hideIcon.classList.toggle('hidden');
        });
    </script>
</x-app-layout>
