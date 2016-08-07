@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit User</div>

                    <div class="panel-body">

                        @if($errors->all())
                            <div class="alert alert-info">{!! Html::ul($errors->all()) !!}</div>
                        @endif

    {!! Form::model($user, ['route'=>['users.update',$user->id], 'method'=> 'PUT']) !!}
    <div class="form-group">
        {!! Form::label('name', 'FirstName') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lastName', 'LastName') !!}
        {!! Form::text('lastName', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-Mail') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('addBook', 'Type Book ID you want to give to user (the book must be free)') !!}
        {!! Form::text('addBook', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Update User',['class' =>'btn btn-primary']) !!}
    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop