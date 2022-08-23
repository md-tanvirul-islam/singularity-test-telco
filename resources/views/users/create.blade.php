<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-4 font-semibold text-xl text-gray-800 leading-tight">Users</div>
            <div class="col-md-8">
                <div class="pull-right">
                    <a href="{{ route('users.index') }}" title="" class="btn btn-secondary">
                        <i class="fa fa-list"  aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body panel-danger">
                        @include('layouts.errors')
                        <h4>User Create Form </h4>
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            @include('users.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
