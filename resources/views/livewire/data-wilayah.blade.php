<div>
    <div class="mb-4.5 w-full">
        <label for="provinsi" class="mb-3 block text-sm font-medium text-black dark:text-white">Provinsi</label>
        <select class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"wire:change='getRegencies' required="" wire:model="provinsi" name="provinsi" id="provinsi" class="input-form-edit">
            <option value="" selected>Pilih Provinsi</option>
            @foreach ($apiProvice as $data)
                        <option value="{{ $data['id'] . '|' . $data['name'] }}">{{Str::title($data['name'])}}</option>
            @endforeach
        </select>
        @error('provinsi') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
    </div>

    <div wire:loading wire:target='getRegencies' class="mb-4.5 w-full">
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kabupaten/Kota</label>
        <input disabled type="text" class="input-form-edit" value="Loading data Kabupaten/Kota ...">
    </div>
    <div wire:loading.remove wire:target='getRegencies' class="mb-4.5 w-full">
        <label for="kota" class="mb-3 block text-sm font-medium text-black dark:text-white">Kabupaten/Kota</label>
        <select class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"wire:change='getDistricts' required="" wire:model="kota" name="kota" id="kota" class="input-form-edit">
            <option selected >Pilih Kabupaten/Kota</option>
            @if ($apiRegencies != null)
            @foreach ($apiRegencies as $data)
                        <option value="{{ $data['id'] . '|' . $data['name'] }}">{{Str::title($data['name'])}}</option>
            @endforeach
            @endif
        </select>
        @error('kabupaten') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
    </div>

    <div wire:loading wire:target='getDistricts' class="mb-4.5 w-full">
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kecamatan</label>
        <input disabled type="text" class="input-form-edit" value="Loading data kecamatan ...">
    </div>
    <div wire:loading.remove wire:target='getDistricts' class="mb-4.5 w-full">
        <label for="kecamatan" class="mb-3 block text-sm font-medium text-black dark:text-white">Kecamatan</label>
        <select class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"wire:change='getVillages' required="" wire:model="kecamatan" name="kecamatan" id="kecamatan" class="input-form-edit">
            <option selected >Pilih Kecamatan</option>
            @if ($apiDistricts != null)
            @foreach ($apiDistricts as $data)
                        <option value="{{ $data['id'] . '|' . $data['name'] }}">{{Str::title($data['name'])}}</option>
            @endforeach
            @endif
        </select>
        @error('kecamatan') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
    </div>

    <div wire:loading wire:target='getVillages' class="mb-4.5 w-full">
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">Kelurahan/Desa</label>
        <input disabled type="text" class="input-form-edit" value="Loading data Kelurahan/Desa ...">
    </div>
    <div wire:loading.remove wire:target='getVillages' class="mb-4.5 w-full">
        <label for="kelurahan" class="mb-3 block text-sm font-medium text-black dark:text-white">Kelurahan/Desa</label>
        <select class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"required="" wire:model="kelurahan" name="kelurahan" id="kelurahan" class="input-form-edit">
            <option selected >Pilih Kelurahan/Desa</option>
            @if ($apiVillages != null)
            @foreach ($apiVillages as $data)
                        <option value="{{ $data['id'] . '|' . $data['name'] }}">{{Str::title($data['name'])}}</option>
            @endforeach
            @endif
        </select>
        @error('kelurahan') <small class=" my-1 text-red-500">{{ $message }}</small> @enderror
    </div>

</div>
