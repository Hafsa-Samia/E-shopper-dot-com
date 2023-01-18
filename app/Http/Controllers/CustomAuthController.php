<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view('form.login');
    }

    public function registration()
    {
        return view('form.registration');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:60'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $status = $user->save();

        if ($status == true) {
            return back()->with('success', 'You are registered Successfully!');
        } else {
            return back()->with('fail', 'Something went Wrong');
        }

        echo ('Value Accepted');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user_profile = User::where('email', '=', $request->email)->first();

        if ($user_profile) {
            if (Hash::check($request->password, $user_profile->password)) {
                $request->session()->put('logId', $user_profile->id);
                $request->session()->put('userName', $user_profile->name);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'The password is not matched!');
            }
        } else {
            return back()->with('fail', 'This email is not Registered!');
        }
    }

    public function dashboard()
    {
        $user_data = [];
        if (Session::has('logId')) {
            $user_data['identification'] = User::where('id', '=', Session::get('logId'))->first();
        }

        $product_data = [];

        $product_data['products'] = Product::all();

        return view('form.dashboard', $user_data, $product_data);
    }

    public function logout()
    {
        Session::forget('logId');
        return redirect('login');
    }
}
