@props([
    'label',
    'name',
    'isChecked' => false,
    'value' => null
])

<div class="mb-4 input-content">
    <div class="form-check">
        <input type="text" name="{{ $name }}[]" id="{{ $name }}" class="form-check-input @error( $name ) is-invalid @enderror"
               value="{{ $value }}" {{ $isChecked ? 'checked' : '' }} autocomplete="nope"/>
        <label for="{{ $name }}" class="capitalize"> {{ $label }} </label>
    </div>
    @error( $name )
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
