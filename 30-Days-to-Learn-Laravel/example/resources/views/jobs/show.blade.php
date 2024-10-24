<x-layout>
  <x-slot:heading>
    Job Page
  </x-slot:heading>
  <h2 class="text-lg font-semibold">
    {{$job['title']}}
  </h2>
  <p class="my-2">
    This job pays <strong> ${{ $job['salary'] }}</strong> per year
  </p>

  <x-button href="/jobs/{{$job['id']}}/edit">Edit Job</x-button>

</x-layout>
