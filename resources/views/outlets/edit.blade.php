<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-4 font-semibold text-xl text-gray-800 leading-tight">Outlets</div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ route('outlets.index') }}" title="Outlets List" class="btn btn-secondary">
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
                    @include('layouts.message')
                    <h4>Outlet Edit Form </h4>
                    <form action="{{ route('outlets.update',$user->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        @include('outlets.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
