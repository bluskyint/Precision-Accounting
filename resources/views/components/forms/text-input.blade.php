@props([
    'label',
    'name',
    'iconClass',
    'placeholder',
    'disabled' => false,
    'value' => null
])

<div class="mb-4 input-content">
    <label for="{{ $name }}" class="capitalize"> <i class="{{ $iconClass }}"></i> {{ $label }} </label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control @error( $name ) is-invalid @enderror"
           value="{{ old($name) ?: $value }}" aria-describedby="emailHelp" placeholder="{{ $placeholder }}"
           autocomplete="nope" {{ $disabled ? 'disabled' : '' }}/>
    @error( $name )
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
