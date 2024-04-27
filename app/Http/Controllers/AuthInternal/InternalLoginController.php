<?php

namespace App\Http\Controllers\AuthInternal;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\UserInternal;

class InternalLoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  use AuthenticatesUsers;
  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  // protected $redirectTo = '/home';
  public function __construct()
  {
    $this->middleware('guest:internal')->except('logout');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function login()
  {
    $users = UserInternal::get();
    return view('auth.logininternal', compact('users'));
  }
  public function logininternal(Request $request)
  {

    // Validate the form data
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);
    // Attempt to log the user in
    if (Auth::guard('internal')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember)) {
      // if successful, then redirect to their intended location
      return redirect()->intended(route('admin.home'));
    } elseif (Auth::guard('internal')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 2], $request->remember)) {
      // if successful, then redirect to their intended location
      return redirect()->intended(route('admin.home'));
    } elseif (Auth::guard('internal')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 3], $request->remember)) {
      // if successful, then redirect to their intended location
      return redirect()->intended(route('admin.home'));
    } else {
      // if unsuccessful, then redirect back to the login with the form data
      // return redirect()->back()->withInput($request->only('email', 'remember'));

      return redirect()->intended('/login-internal')->with('error', 'Cek Kembali email dan password');
    }
    // if unsuccessful, then redirect back to the login with the form data

    return redirect()->intended('/login-internal')->with('error', 'Cek Kembali email dan password');
    // return redirect()->back()->withInput($request->only('email', 'remember'));
  }
  public function logout()
  {
    Auth::guard('internal')->logout();
    return redirect()->route('home');
  }
}
