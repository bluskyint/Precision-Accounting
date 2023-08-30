@props([
    'label',
    'name',
    'value' => null
])

<div class="mb-4 input-content">
    <label for="editor" class="capitalize"> <i class="fa-solid fa-align-left"></i> {{ $label }} </label>
    <textarea id="editor" name="{{ $name }}">{!! old($name) ?: $value !!}</textarea>
    @error( $name )
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
