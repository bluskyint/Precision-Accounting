@props([
    'label',
    'name',
    'iconClass',
])

<div class="mb-4 input-content">
    <label for="{{ $name }}" class="capitalize"> <i class="{{ $iconClass }}"></i> {{ $label }} </label>
    <select class="form-select form-control custom-select" name="{{ $name }}" id="{{ $name }}" aria-label="Default select example" >
        <option disabled selected>Select</option>
        {{ $slot }}
    </select>
    @error($name)
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
