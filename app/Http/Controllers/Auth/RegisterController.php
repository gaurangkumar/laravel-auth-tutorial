<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected function validator(array $data)
    {
      return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'address' => ['required'],
        'gender' => ['required'],
        'phone' => ['required', 'string', 'max:15', 'min:8'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'phone' => $data['phone'],
        'gender' => $data['gender'],
        'address' => $data['dob'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
      ]);
    }
}
