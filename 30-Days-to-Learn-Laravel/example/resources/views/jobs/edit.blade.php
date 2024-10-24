<x-layout>
  <x-slot:heading>
    Edit Job: {{ $job->title }}
  </x-slot:heading>
  <form action="/jobs/{{ $job->id  }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Edit job</h2>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <div class="mt-2">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                <input type="text" name="title" id="title"
                       class="block flex-1 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 outline-none pl-3"
                       placeholder="product manager" value="{{ $job->title  }}" required />
              </div>
              <p class="mt-1 text-red-600 text-xs font-semibold">
                @error('title')
                {{ $message }}
                @enderror
              </p>
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="salary" class="block text-sm font-medium leading-6 text-gray-900">Salary</label>
            <div class="mt-2">
              <div
                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                <input type="text" name="salary" id="salary"
                       class="block flex-1 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 outline-none pl-3"
                       placeholder="$50,000 per year" value="{{ $job->salary }}" required />
              </div>
              <p class="mt-1 text-red-600 text-xs font-semibold">
                @error('salary')
                {{ $message }}
                @enderror
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="mt-6 flex items-center justify-between gap-x-6">
      <div>
        <a ></a>
        <button form="delete-job"
                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>      </div>
      <div>


      <a href="/jobs/{{ $job->id }}" >
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
      </a>
      <button type="submit"
              class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
    </div>
    </div>
  </form>

  <form method="POST" action="/jobs/{{ $job->id }}" class="hidden" id="delete-job" >
    @csrf
    @method('DELETE')
  </form>
</x-layout>
