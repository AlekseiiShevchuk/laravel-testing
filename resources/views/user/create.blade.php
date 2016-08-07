@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
               <div class="panel-heading">Create User</div>

               <div class="panel-body">

                  @if($errors->all())
                     <div class="alert alert-info">{!! Html::ul($errors->all()) !!}</div>
                  @endif

   {!! Form::open(['url'=>'users']) !!}
      <div class="form-group">
         {!! Form::label('name', 'FirstName') !!}
         {!! Form::text('name', Input::old('name'), ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
         {!! Form::label('lastName', 'LastName') !!}
         {!! Form::text('lastName', Input::old('lastName'), ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
         {!! Form::label('email', 'E-Mail') !!}
         {!! Form::text('email', Input::old('email'), ['class' => 'form-control']) !!}
      </div>
    {!! Form::submit('Create User',['class' =>'btn btn-primary']) !!}
   {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
@stop