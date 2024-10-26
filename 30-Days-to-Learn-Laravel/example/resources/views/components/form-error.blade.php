@props(['name'])
<p class="mt-1 text-red-600 text-xs font-semibold">
  @error($name)
  {{ $message }}
  @enderror
</p>