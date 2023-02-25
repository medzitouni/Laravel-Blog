<x-app-layout>
    <x-slot name="header">
        {{ __('Update an article') }}
    </x-slot>

    <div>
        
  
            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
              <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <!-- Title -->
                <div>
                    <label class="block text-sm font-bold text-gray-700" for="title">
                        Title
                    </label>
                    <input
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        type="text" name="title" value="{{ old('title', $article->title) }}" placeholder="255" />
                    @error('title')
                        <span class="font-medium text-red-600" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Content of the article -->
                <div>
                    <label class="block text-sm font-bold text-gray-700" for="article">
                      Article
                    </label>
                    <textarea name="article"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        rows="4" placeholder="600">{{ old('article', $article->article) }}</textarea>
                    @error('article')
                        <span class="font-medium text-red-600" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Categories -->
                <div>
                    <label class="block text-sm font-bold text-gray-700" for="category">
                        Category
                    </label>
                    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                        name="category_id">
                        <option value="0">SELECT CATEGORY</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $article->category_id) selected @endif
                                >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="font-medium text-red-600" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-bold text-gray-700" for="tags">
                        Tags
                    </label>
                    <input
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        type="text" name="tags" value="{{ old('tags', $tags) }}" placeholder="255" />
                    <span class="text-xs text-gray-600">Separated by comma</span>
                    @error('tags')
                        <span class="font-medium text-red-600" role="alert">{{ $message }}</span>
                    @enderror
                </div>
  
                <!-- Image-->
                <div>
                    <label class="block text-sm font-bold text-gray-700" for="title">
                      Image
                    </label>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                        Upload image
                    </label>
                    <input 
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                        name="image" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                        SVG, PNG, JPG or GIF .
                    </p>

                    @error('image')
                        <span class="font-medium text-red-600" role="alert">{{ $message }}</span>
                    @enderror

                    
                </div>


                <div class="flex items-center justify-start mt-4 gap-x-2">
                  <button type="submit"
                    class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                    Save
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
