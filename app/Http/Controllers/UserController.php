<?php

namespace App\Http\Controllers;

use App\Providers\UserServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function RegisterUser(Request $request)
    {
        $incomingFields = $request -> validate(
        [
            'image' => ['image','mimes:jpeg,png,jpg'],
            'name' => ['required','min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => ['required','min:8'], 
        ],
        [
            
            'name.required' => 'Must contain a name',
            'name.min:2' => 'Name must have at least two characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'password.required' => 'Password is required',
            'password.min:8' => 'Password must have at least 8 characters'
            
        ]);  
    

        if(!UserServiceProvider::registerUser($incomingFields, $request) == true) {
            return redirect('/')->with('error','Registration failed.');
        }

        return redirect('/movies')->with('success','Registration successful');

    }

    
}
