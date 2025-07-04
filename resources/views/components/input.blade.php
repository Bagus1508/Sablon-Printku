@props([
    'label' => 'Label',
    'name',
    'id',
    'value',
    'disabled' => false,
    'readonly' => false,
    'classInput' => null,
    'type' => 'text',
])

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $id ?? $name }}">
        {{ $label }}
    </label>
    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $classInput }}" type="{{ $type }}"
        id="{{ $id ?? $name }}" name="{{ $name }}" type="text" placeholder="{{ $label }}" value="{{ $value ?? '' }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }}>
</div>
