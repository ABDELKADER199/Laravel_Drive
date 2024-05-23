<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New Drive
        </h2>
    </x-slot>
    <div class="container col-md-6">
        <div class="card mt-5 bg-dark text-white">
            @if (Session::has('done'))
                <div class="alert alert-success">
                    {{ Session::get('done') }}
                </div>
            @endif
            <div class="card-body text-center">
                <form method="POST" action="{{ route('drive.store') }} " enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2">
                        <label class="my-2" for="">Title</label>
                        <input type="text" value="{{ old('title') }}" name="title"
                            class=" @error('title') is-invalid @enderror form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="form-group my-2">
                        <label class="my-2" for="">Drive</label>
                        <input type="file" value="{{ old('drive') }}" name="drive"
                            class=" @error('drive') is-invalid @enderror form-control">
                        @error('drive')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label class="my-2" for="">Description</label>
                        <input type="text" value="{{ old('description') }}" name="description"
                            class=" @error('description') is-invalid @enderror form-control">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label class="my-2" for="">Category Id</label>
                        <select name="category_id" class="form-select">
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-info">Create New</button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
