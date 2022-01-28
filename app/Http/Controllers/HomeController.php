<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        \View::share('currentRoute', Route::currentRouteName());
    }

    public function index()
    {
        $user = auth()->user();

        return view('dashboard', compact('user'));
    }

    public function profile(Request $request)
    {
        $user = auth()->user();
        echo "<pre>";print_r($request->toArray());exit;

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'gender' => 'required|string',
            'hobby' => 'required|array',
            'address' => 'required|string',
            'country' => 'required|string',
        ]);

        if ($user->email !== $request->email) {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'hobby' => $request->hobby,
            'address' => $request->address,
            'country' => $request->country,
        ];

        if (! empty($request->profile)) {
            $request->validate([
                'profile' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            ]);

            $image = $request->profile->store('profile', ['disk' => 'public']);

            $data['profile'] = $image;
        }

        $result = $user->update($data);

        return redirect()->route('settings');
    }
}
