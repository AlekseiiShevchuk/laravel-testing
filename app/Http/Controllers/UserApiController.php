<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Http\Requests;

class UserApiController extends Controller
{


    public function addBookToUser($userId,$bookId)
    {
        $user = User::find($userId);
        if(!$user){
            return response('There is no user with id ' . $userId, 404);
        }

        $book = Book::find($bookId);
        if(!$book){
            return response('There is no book with id'.$bookId,404);
        }elseif ($book->user_id == $userId){
            return response('This user already has this book',406);
        }elseif ($book->user_id != 0){
            return response('This book uses by other member',406);
        }

        $user->books()->save($book);

        return 'Book added successfully, user updated';
    }


    public function showBooks($id)
    {
        $user = User::find($id);
        if($user){
            return $user->books;
        }else{
            return response('There is no user with id ' . $id, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return $user;
        }else{
            return response('There is no user with id ' . $id, 404);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name' => 'required|alpha', //alpha - поле может содержать только буквы
            'lastName' => 'required|alpha',
            'addBook' => 'exists:books,id,user_id,NULL'
        ];
        if ($user->email != $request->email){
            $rules['email'] = 'required|email|unique:users';
        }

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response('',406);
        }else{
            $user->name = $request->name;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->save();

            $message ='Successfully updated user';
            return $message;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Book::find($id);
        if($user){
            $user->delete();
            $message='User with ID:' .$id. ' Successfully deleted';
            return $message;
        }else{
            $message='ERROR: There is no User with ID:' .$id;
            return response($message,406);
        }
    }
}
