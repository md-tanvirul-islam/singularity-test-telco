@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4">Subjects</div>
                            <div class="col-md-8">
                                <div class="pull-right">
                                    <a href="{{ route('subjects.index') }}" title="Subject's list" class="btn btn-info">
                                        <i class="fa fa-list"  aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body panel-danger">

                        @include('admin.layouts.errors')

                        <h4>Subjects Create Form </h4>

                        {!! Form::open(['route'=>'subjects.store','method'=>'POST']) !!}

                        @include('admin.subjects.form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection