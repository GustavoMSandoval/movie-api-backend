<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserServiceProvider extends ServiceProvider
{
 
    public static function registerUser(array $incomingFields): RedirectResponse 
    {
        
        //if($incomingFields->hasFile('image')) {$path = $incomingFields->file('image')->store('images','public');}

        if($incomingFields['name'] == '') {
            return redirect('/');
        }

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        Auth::login($user);

        return redirect('/movies');
        
    }
   

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
