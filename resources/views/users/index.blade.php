<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-4 font-semibold text-xl text-gray-800 leading-tight">Users</div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ route('users.create') }}" title="Create User" class="btn btn-info">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body panel-danger">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <th scope="row">{{ $users->firstItem() +$index }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ Str::ucfirst($user->role) }}</td>
                                        <td>{{ $user->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{ route('users.edit', $user->id) }}"> <i class="fa fa-pencil"></i> </a>
                                            <a class="btn btn-success btn-sm" href="{{ route('users.show', $user->id) }}"> <i class="fa fa-eye"></i> </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
