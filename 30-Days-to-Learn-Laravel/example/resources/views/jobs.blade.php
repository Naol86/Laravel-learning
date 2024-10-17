<x-layout>
  <x-slot:heading>
    Jobs Page
  </x-slot:heading>
  <div class="space-y-2">

    @foreach ($jobs as $job)
    <a href="/jobs/{{ $job['id'] }}" class="block border-2 rounded-md p-5">
      <div class="text-blue-500 font-semibold">
        {{ $job->employer->name}}
      </div>
      <strong>
        {{ $job['title'] }} :
      </strong>
      ${{ $job['salary'] }}
      <strong>
        per year
      </strong>
    </a>
    @endforeach
  </div>
</x-layout>