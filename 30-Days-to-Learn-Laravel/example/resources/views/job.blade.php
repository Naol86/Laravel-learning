<x-layout>
  <x-slot:heading>
    Job Page
  </x-slot:heading>
  <h2 class="text-lg font-semibold">
    {{$job['title']}}
  </h2>
  <p>
    This job pays <strong> ${{ $job['salary'] }}</strong> per year
  </p>
</x-layout>