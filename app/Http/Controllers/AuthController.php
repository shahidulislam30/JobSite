<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginView(){
        if (Auth::check()){
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        $rules = [
            'email' => 'required',
            'password' =>'required',
        ];

        $message = [];

        $validation = Validator::make($request->all(),$rules,$message);

        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }else{
            if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){

                if (auth()->user()->user_type == 1){
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->route('profile');
                }

            }else{
                session()->flash('error','Invalid email and password');
                return redirect()->back()->withInput();
            }
        }
    }


    public function registerView(){
        if (Auth::check()){
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request){
        $rules = [
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'email' => 'required|max:50|unique:users',
            'user_type' => 'required',
            'password' =>'required|min:5|max:15',
            'confirm_password' => 'required|same:password|min:5',
        ];

        $message = [];

        if ($request->user_type == 1){
            $rules['business_name'] =  'required';
        }

        $validation = Validator::make($request->all(),$rules,$message);

        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }else{
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->password = bcrypt($request->password);
            $user->business_name = $request->business_name ?? '';

            if ($user->save()){
                session()->flash('success','Registration Complete');
				Auth::loginUsingId($user->id);
                if (auth()->user()->user_type == 1){
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->route('profile');
                }
            }else{
                session()->flash('error','Registration not Complete');
                return redirect()->back();
            }
        }
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect()->route('login.view');
    }
}
