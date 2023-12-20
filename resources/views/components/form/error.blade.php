@props(['name'])
@error("$name")
<p class="text-sm text-red-600 mt-3">
    {{ $message }}
</p>
@enderror
