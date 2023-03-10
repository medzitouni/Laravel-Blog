<x-app-layout>
    <x-slot name="header">
        {{ __('Update a tag') }}
    </x-slot>

    <div>
        
  
            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
              <form method="POST" action="{{ route('tags.update', $tag->id) }}">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <!-- Name -->
                <div>
                  <label class="block text-sm font-bold text-gray-700" for="title">
                    Name
                  </label>
  
                  <input
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="text" name="name" value="{{$tag->name}}"placeholder="255" />
                </div>
  
  
                <div class="flex items-center justify-start mt-4 gap-x-2">
                  <button type="submit"
                    class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                    Update
                  </button>
                  <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-gray-100 bg-gray-400 rounded-md shadow-md hover:bg-gray-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                    Cancel
                  </button>
                </div>
              </form>
            </div>

      </div>

</x-app-layout>
