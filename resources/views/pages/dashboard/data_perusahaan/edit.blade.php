<div wire:ignore.self id="modal-edit-perusahaan"
    class="hs-overlay hidden w-full h-screen overflow-x-hidden overflow-y-auto fixed top-0 left-0 z-999999 bg-black/80 [--overlay-backdrop:static]">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">

        <div class="p-4 sm:p-7">
            <div class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div
                    class="border-b border-stroke px-6.5 py-4 dark:border-strokedark flex justify-between self-baseline">
                    <h3 class="font-medium text-black dark:text-white">
                        Edit Data Perusahaan
                    </h3>
                    <div>
                        <button data-hs-overlay="#modal-edit-perusahaan" type="button"
                            class="justify-center items-center rounded-md p-1 border font-medium bg-white dark:bg-slate-800 text-gray-700 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-red-500 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{route('data-perusahaan.update', (int)$ID)}}">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="p-6.5">
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Nama Perusahaan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="text" value="{{ $Nama_perusahaan }}" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukan Nama Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Kode Perusahaan <span class="text-red-500 text-[10px]">*(Wajib diisi)</span>
                            </label>
                            <input type="text" value="{{ $Kode_perusahaan }}" id="kode_perusahaan" name="kode_perusahaan" placeholder="Masukan Nama Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                No Telepon
                            </label>
                            <input type="number" value="{{ $No_telepon }}" id="no_telepon" name="no_telepon" placeholder="Masukan No Telepon"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Email
                            </label>
                            <input type="email" value="{{ $Email }}" id="email" name="email" placeholder="Masukan Email Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <div class="mb-4.5 w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Alamat Perusahaan
                            </label>
                            <textarea type="text" id="alamat" name="alamat" placeholder="Masukan Nama Alamat Perusahaan"
                                class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">{{$AlamatJalan}}</textarea>
                        </div>
                        <div>
                            <div class="mb-4.5 w-full">
                                <label for="provinsi" class="mb-3 block text-sm font-medium text-black dark:text-white">Provinsi</label>
                                <select wire:change='getRegencies' wire:model="ID_provinsi" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" wire:change='getRegencies' required="" name="provinsi" id="provinsi" class="input-form-edit">
                                    <option selected>Pilih Provinsi</option>
                                    @foreach ($apiProvice as $data)
                                        <option value="{{ $data['id'] . '|' . $data['name'] }}" {{ $data['id'] == $Provinsi ? 'selected' : '' }}>{{Str::title($data['name'])}}</option>
                                    @endforeach
                                </select>
                                @error('id_provinsi') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
                            </div>
                        
                            <div wire:loading wire:target='getRegencies' class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kabupaten/Kota</label>
                                <input disabled type="text" class="input-form-edit" value="Loading data Kabupaten/Kota ...">
                            </div>
                            <div wire:loading.remove wire:target='getRegencies' class="mb-4.5 w-full">
                                <label for="kota" class="mb-3 block text-sm font-medium text-black dark:text-white">Kabupaten/Kota</label>
                                <select wire:change='getDistricts' wire:model="ID_kota" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"wire:change='getDistricts' required="" name="kota" id="kota" class="input-form-edit">
                                    <option selected >Pilih Kabupaten/Kota</option>
                                    @if ($apiRegencies != null)
                                    @foreach ($apiRegencies as $data)                                                
                                        <option value="{{ $data['id'] . '|' . $data['name'] }}" {{ $data['id'] == $Kota ? 'selected' : '' }}>{{Str::title($data['name'])}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('id_kota') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
                            </div>
                        
                            <div wire:loading wire:target='getDistricts' class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kecamatan</label>
                                <input disabled type="text" class="input-form-edit" value="Loading data kecamatan ...">
                            </div>
                            <div wire:loading.remove wire:target='getDistricts' class="mb-4.5 w-full">
                                <label for="kecamatan" class="mb-3 block text-sm font-medium text-black dark:text-white">Kecamatan</label>
                                <select wire:change='getVillages' wire:model="ID_kecamatan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"wire:change='getVillages' required="" name="kecamatan" id="kecamatan" class="input-form-edit">
                                    <option selected >Pilih Kecamatan</option>
                                    @if ($apiDistricts != null)
                                    @foreach ($apiDistricts as $data)
                                                <option value="{{ $data['id'] . '|' . $data['name'] }}" {{ $data['id'] == $Kecamatan ? 'selected' : '' }}>{{Str::title($data['name'])}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('id_kecamatan') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
                            </div>
                        
                            <div wire:loading wire:target='getVillages' class="mb-4.5 w-full">
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kelurahan/Desa</label>
                                <input disabled type="text" class="input-form-edit" value="Loading data Kelurahan/Desa ...">
                            </div>
                            <div wire:loading.remove wire:target='getVillages' class="mb-4.5 w-full">
                                <label for="kelurahan" class="mb-3 block text-sm font-medium text-black dark:text-white">Kelurahan/Desa</label>
                                <select wire:model="ID_kelurahan" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"required="" name="kelurahan" id="kelurahan" class="input-form-edit">
                                    <option selected >Pilih Kelurahan/Desa</option>
                                    @if ($apiVillages != null)
                                    @foreach ($apiVillages as $data)
                                                <option value="{{ $data['id'] . '|' . $data['name'] }}" {{ $data['id'] == $Kelurahan ? 'selected' : '' }}>{{Str::title($data['name'])}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('id_kelurahan') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
                            </div>
                        </div>                        
                        <div class="mb-4.5 w-full flex gap-3 justify-between">
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    RT
                                </label>
                                <input type="number" id="rw" value="{{$Rt}}" name="rt" placeholder="Masukan RT Perusahaan"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    RW
                                </label>
                                <input type="number" id="rw" value="{{$Rw}}" name="rw" placeholder="Masukan RT Perusahaan"
                                    class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-boxdark flex justify-center">
                        <button type="submit" class="flex justify-center rounded w-full m-4 -mt-4 bg-primary font-medium p-2 text-gray hover:bg-opacity-90">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
