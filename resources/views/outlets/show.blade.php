<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-4 font-semibold text-xl text-gray-800 leading-tight">Outlets</div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ route('outlets.index') }}" title="" class="btn btn-secondary">
                        <i class="fa fa-list"  aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3><strong>Outlet Name - </strong>{{ $user->name }}</h3>
                        <h3><strong>User Email - </strong>{{ $user->email }}</h3>
                        <p><strong>Created At - </strong>{!! $user->created_at  !!}   <mark>{{ $user->created_at->diffForHumans() }}</mark></p>
                        @if(!is_null($user->updated_at))
                            <p><strong>Updated At - </strong>{{ $user->updated_at }}  <mark>{{ $user->updated_at->diffForHumans() }}</mark></p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
