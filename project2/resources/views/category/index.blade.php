<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            View All Category
        </h2>
    </x-slot>
    <div class="container col-md-6">

        <div class="card mt-5 bg-dark text-white">
            <a href="{{route('category.create')}}" class="btn btn-info">Create New</a>
            <div class="card-body text-center">

                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th colspan="2">Action</th>
                    </tr>
                    @foreach ($category as $item)
                    <tr>
                        <th>{{$item->id}}</th>
                        <th>{{$item->title}}</th>
                        <th>{{$item->description}}</th>
                        <th>
                            <a href="{{route('category.edit' , $item->id)}}">Edit</a>
                        </th>
                        <th>
                            <a href="{{route('category.destroy' , $item->id)}}">Delete</a>
                        </th>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>

    </div>
</x-app-layout>
