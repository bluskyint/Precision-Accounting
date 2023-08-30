@props([
    'label',
    'name',
    'iconClass',
    'placeholder',
    'value' => null
])

<div class="mb-4 input-content">
    <label for="{{ $name }}" class="capitalize"> <i class="{{ $iconClass }}"></i> {{ $label }} </label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control @error( $name ) is-invalid @enderror"
           value="{{ old($name) ?: $value }}" aria-describedby="emailHelp" placeholder="{{ $placeholder }}"
           autocomplete="nope"/>
    @error( $name )
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
