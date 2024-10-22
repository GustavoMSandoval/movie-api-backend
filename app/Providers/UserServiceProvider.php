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
 
    public static function registerUser(array $incomingFields, Request $request): bool
    {
        
        if($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images','public');
        $incomingFields['image'] = $imagePath;
        }

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        try {

            $user = User::create($incomingFields);
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json(['token' => $token], 201);

            Auth::login($user);
            

        } catch(\Exception $e) {
            return false . $e;
        }
        
    }
   

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
