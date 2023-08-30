@props([
    'name',
    'label',
    'altTextValue' => null,
])

<div class="mb-4 input-content">
    <label for="{{ $name }}_src" class="form-label d-flex align-items-center">
        <i class="fa-solid fa-image"></i> &nbsp; {{ $label }}
        {{ $slot }}
    </label>
    <input name="{{ $name }}[src]" type="file" class="form-control @error("$name.src") is-invalid @enderror" id="{{ $name }}_src" />
    @error("$name.src")
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>

<!----------------- Img Alternative Text -------------------->
<div class="mb-4 input-content">
    <label for="{{ $name }}_alt_text" class="capitalize"> <i class="fa-solid fa-image"></i> {{ $label }} Alternative Text </label>
    <input type="text" name="{{ $name }}[alt]" id="{{ $name }}_alt_text" class="form-control @error("$name.alt") is-invalid @enderror" value="{{ old("$name.alt") ?: $altTextValue }}" aria-describedby="emailHelp" placeholder="Type Alt Text..." autocomplete="nope" />
    @error("$name.alt")
    <small class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
