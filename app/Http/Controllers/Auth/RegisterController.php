<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        try {
            // $this->validator($request->all())->validate();
            $user = $this->create($request->all());
            auth()->login($user);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
