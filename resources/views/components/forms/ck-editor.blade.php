@props([
    'label',
    'name',
    'id' => 'editor',
    'value' => null,
])

<div class="mb-4 input-content">
    <label for="{{ $id }}" class="capitalize"> <i class="fa-solid fa-align-left"></i> {{ $label }} </label>
    <textarea id="{{ $id }}" name="{{ $name }}">{!! old($name) ?: $value !!}</textarea>
    @error( $name )
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
