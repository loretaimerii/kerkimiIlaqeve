<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //register function
    public function register(Request $request){
        //to validate the data 
        $incomingFields = $request->validate([
            'name' => ['required','min:3','max:15'],
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','min:8','max:50']
        ]);

        // hash the password so the actual value is not stored in the database
        $incomingFields['password']=bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }

    // login function
    public function login(Request $request){
        $incomingFields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // to check if the user exists
        if(auth()->attempt(['email'=>$incomingFields['email'],'password'=>$incomingFields['password']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    //logout function
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
