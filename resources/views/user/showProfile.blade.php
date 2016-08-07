@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">User Profile</div>

                    <div class="panel-body">
    <table class="table table-bordered">
        <tbody>

            <tr><th>Your ID:</th><td>{{$user->id}}</td></tr>
            <tr><th>FirstName</th><td>{{$user->name}}</td></tr>
            <tr><th>LastName</th><td>{{$user->lastName}}</td></tr>
            <tr><th>E-Mail</th><td>{{$user->email}}</td></tr>
            <tr><th>Books that you have gotten:</th>
                <td>
                    @if(count($user->books) == 0)
                        You do not have any books yet!
                    @endif
                    <ul>
                        @foreach($user->books as $book)
                            <li>{{$book->title}}</li>
                        @endforeach
                    </ul>
                </td></tr>

        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

