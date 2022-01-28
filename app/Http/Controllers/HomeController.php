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

        //echo "<pre>";var_dump($user->businesses[0]);exit;

        return view('dashboard', compact('user'));
    }


    public function settings()
    {
        $title = 'Settings | Agwis Messenger';
        $user = auth()->user();

        $side_chats = $this->get_last_chats($user->id);

        $pages = $this->get_pages($user->id);

        $friends = $this->get_friends($user->id);
        $sender = null;

        return view('settings', compact('title', 'side_chats', 'pages', 'sender', 'friends', 'user'));
    }

    public function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k.' '.$v.($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (! $full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string).' ago' : 'just now';
    }

    public function profile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
        ]);

        if ($user->email !== $request->email) {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
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

    public function delete_profile(Request $request)
    {
        $user = auth()->user();

        $result = $user->update(['profile' => null]);

        return redirect()->route('settings');
    }

    public static function number_abbr($number)
    {
        $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];
        $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];

        foreach ($abbrevs as $exponent => $abbrev) {
            if (abs($number) >= pow(10, $exponent)) {
                $display = $number / pow(10, $exponent);
                $decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
                $number = number_format($display, $decimals).$abbrev;
                break;
            }
        }

        return $number;
    }
}
