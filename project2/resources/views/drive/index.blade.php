<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            View All Category
        </h2>
    </x-slot>
    <div class="container col-md-6">

        <div class="card mt-5 bg-dark text-white">
            <a href="{{ route('drive.create') }}" class="btn btn-info">Create New</a>
            <div class="card-body text-center">

                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th colspan="3">Action</th>
                    </tr>
                    @foreach ($drive as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <th>{{ $item->title }}</th>
                            <th>{{ $item->description }}</th>
                            @if (Auth::user()->id == $item->user_id)
                            @if ($item->status == 'public')
                                <th>
                                    <a href="{{ route('drive.changeStatus', $item->id) }}"
                                        class="text-success">Public</a>
                                </th>
                            @else
                                <th>
                                    <a href="{{ route('drive.changeStatus', $item->id) }}"
                                        class="text-danger">Private</a>
                                </th>
                            @endif

                            <th>
                                <a href="{{ route('drive.destroy', $item->id) }}">Delete</a>
                            </th>
                            @endif
                            <th>
                                <a href="{{ route('drive.show', $item->id) }}">Show</a>
                            </th>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>

    </div>
</x-app-layout>
