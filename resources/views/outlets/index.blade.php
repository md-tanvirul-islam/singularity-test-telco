<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-4 font-semibold text-xl text-gray-800 leading-tight">Outlets</div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ route('outlets.create') }}" title="Create Outlet" class="btn btn-info">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('layouts.message')
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($outlets as $index => $outlet)
                                <tr>
                                    <th scope="row">{{ $outlets->firstItem() +$index }}</th>
                                    <td>{{ $outlet->name }}</td>
                                    <td>{{ $outlet->phone }}</td>
                                    <td>{{ $outlet->latitude }}</td>
                                    <td>{{ $outlet->longitude }}</td>
                                    <td>{{ $outlet->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="{{ route('outlets.edit', $outlet->id) }}"> <i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-success btn-sm" href="{{ route('outlets.show', $outlet->id) }}"> <i class="fa fa-eye"></i> </a>
                                        <form action="{{ route('outlets.destroy', $outlet->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Confirm delete?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $outlets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
