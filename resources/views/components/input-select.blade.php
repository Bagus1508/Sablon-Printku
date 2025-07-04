@props([
    'name',
    'id' => null,
    'label' => null,
    'required' => false,
    'selected' => null,
    'onchange' => null,
    'show_label' => true,
    'status_type' => null,
    'add_all' => false,
    'placeholder' => '',
    'selectData' => [],
])

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $id ?? $name }}">
        {{ $label }}
    </label>
    <select name="{{ $name }}" id="{{ $id ? $id : $name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline z-50"
        {{ $onchange ? "onchange=$onchange" : '' }} {{ $attributes }}>
        <option {{ empty($selected) ? 'selected' : '' }} disabled>{{ $placeholder }}</option>

        @foreach ($selectData as $value => $label)
            <option value="{{ $value }}" {{ (string) $value === (string) $selected ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach

        @if (empty($selectData) && !$placeholder)
            <option disabled>Pilihan tidak tersedia</option>
        @endif
    </select>
</div>
