<x-layout>
  <x-slot:heading>
    Jobs Page
  </x-slot:heading>
  @foreach ($jobs as $job)
  <li>
    <a href="/jobs/{{ $job['id'] }}" class="text-blue-500 hover:underline">
      <strong>
        {{ $job['title'] }} :
      </strong>
      ${{ $job['salary'] }}
      <strong>
        per year
      </strong>
    </a>
  </li>
  @endforeach
</x-layout>