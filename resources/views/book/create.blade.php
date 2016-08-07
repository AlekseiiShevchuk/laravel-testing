@extends('layouts.app')

         @section('content')
            <div class="container">
               <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                     <div class="panel panel-default">
                        <div class="panel-heading">Create BOOK</div>

                        <div class="panel-body">

                           @if($errors->all())
                              <div class="alert alert-info">{!! Html::ul($errors->all()) !!}</div>
                           @endif

            {!! Form::open(['url'=>'books']) !!}

            <div class="form-group">
               {!! Form::label('title', 'Book Title') !!}
               {!! Form::text('title', Input::old('title'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
               {!! Form::label('author', 'Book Author') !!}
               {!! Form::text('author', Input::old('author'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
               {!! Form::label('year', 'Year of publishing') !!}
               {!! Form::text('year', Input::old('year'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
               {!! Form::label('genre', 'Genre of the Book') !!}
               {!! Form::text('genre', Input::old('genre'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
               {!! Form::label('user_id', 'ID of user who has gotten the book') !!}
               {!! Form::text('user_id', Input::old('user_id'), ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Create Book',['class' =>'btn btn-primary']) !!}

            {!! Form::close() !!}

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @stop




