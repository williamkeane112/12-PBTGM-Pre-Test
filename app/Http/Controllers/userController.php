<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    /**
     * Link To login page
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login', [
            'page' => 'login',
            'titel' => 'Login',
            'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, perspiciatis.'
        ]);
    }
    public function register(){
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register', [
            'page' => 'register',
            'titel' => 'Register',
            'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, perspiciatis.'
        ]);
    }
    /**
     * Create User Data
     */
        public function StoreRegister(Request $request) {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:4'
            ]);
            $user = User::create([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password' => Hash::make($validate['password'])
            ]);
            
            return redirect()->intended('/login')->with('success', 'create user  successfully');
        }
    
    public function Login(Request $request) {
        $validate = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:4'
        ]);
        if(Auth::attempt($validate)){
            return redirect()->intended('/')->with('success', 'Login successful');
        }

        return back()->withErrors([
            'email' => 'pasword or email do not match',
        ]);
    }


    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        return view('Profile.index', [
            'page' => 'login',
            'titel' => 'Profil',
            'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, perspiciatis.',
            'data' => User::where('id',$id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'old_password' => 'string|min:4', 
            'new_password' => 'string|min:4', 
        ]);
        $user = User::findOrFail($id);
        if($validated['old_password'] === $validated['new_password']){
            return back()->withErrors(['new_password' => 'old Password and new password cannot be same']);
        }

        if ($request->filled('old_password')) {
            if (!Hash::check($validated['old_password'], $user->password)) {
                return back()->withErrors(['old_password' => 'The old password does not match our records.']);
            }
    
            // If old password matches, update the new password
            if ($request->filled('new_password')) {
                $user->password = Hash::make($validated['new_password']);
            }
        }
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();
        return redirect()->intended('/')->with('success', 'Profile updated successfully.');
    }
    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('/login')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
