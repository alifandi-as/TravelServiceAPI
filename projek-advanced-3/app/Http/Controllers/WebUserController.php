<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WebUserController extends ExtController
{
      // Mendapatkan semua user
      public function index(){
        $users = User::query()
                ->get()
                ->toArray();
        return $this->send_success($users);
    }

     // Menampilkan sebuah user berdasarkan id
     // (id)
    public function show($id = 0){
        $users = User::query()
                ->where("id", "=", $id)
                ->get()
                ->toArray()[0];
        return $this->send_success($users);
    }
    
    // Mendaftar user dan menambah user ke database
    // (name, email, image, password, password confirmation)
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string|max_digits:255',
            'email' => ['required', 'email', 'max_digits:255', 'unique:users,email'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,bmp,tif,tiff,webp,avif', 'dimensions:max_width=4096,max_height=`4096'],
            'password' => ['required', 'string', 'digits_between:8,255', 'confirmed'],
        ]);

        $name = $fields["name"];
        $password = bcrypt($fields["password"]);
        //$token = sha1($password);
        $email = $fields["email"];
            
        $img = $request->file('image');
        /*
        $name = filter_input(INPUT_POST, $request->name, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = Hash::make(filter_input(INPUT_POST, $request->password, FILTER_SANITIZE_SPECIAL_CHARS));
        $token = sha1($password);
        */
        // $email = filter_input(INPUT_POST, $request->email, FILTER_SANITIZE_EMAIL);
        
        $destination = "uploads/profile_pic";

        $user = User::create([
            "name" => $name,
            "password" => $password,
            "email" => $email,
        ]);

        // Login
        auth()->login($user);

        if (!$request->hasFile('image') || $img->move($destination, $name)){
            return redirect("/kelasku");
        }
        else{
            return redirect()->back()->withErrors("Gagal mengunggah gambar");
        }
        
    }

    // Mengubah profil user
    // (name)
    public function edit_profile(Request $request){
        $form_fields = $request->validate([
            'name' => 'required|string|max_digits:255',
        ]);
        $img = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,bmp,tif,tiff,webp,avif', 'dimensions:max_width=4096,max_height=`4096']
        ]);

        $img = $request->file('image');

        if (file_exists(url("/uploads/profile_pic/".auth()->user()->name)))
        {
            rename(public_path("/images/player_icons/".auth()->user()->name), public_path('/images/player_icons/'.$form_fields["name"]));
        }
        if (isset($img)){
            $destination = "uploads/profile_pic";
            $img->move($destination, $form_fields["name"]);
        }
        User::query()
            ->where("id", "=", auth()->id())
            ->update($form_fields);
        $request->session()->regenerate();
        clearstatcache();
        return redirect("/profile");
    }

    // Mengubah password user
    // (name, email, old password, new password, new password confirmation)
    public function edit_password(Request $request){
        $prior_form_fields = ['name' => auth()->user()->name,
                            'email' => auth()->user()->email,
                            'password' => $request->old_password];
        // dd($prior_form_fields['password']);
        // Hash password
        

        if(auth()->attempt($prior_form_fields)){
            
            $form_fields = $request->validate([
                'new_password' => ['required', 'confirmed', 'string', 'digits_between: 8,255'],
            ]);
            $form_fields['new_password'] = bcrypt($form_fields['new_password']);
            User::query()
                ->where("id", "=", auth()->id())
                ->update(["password" => $form_fields["new_password"]]);
            $request->session()->regenerate();
            return redirect("/profile");
        }
        return redirect()->back()->withErrors("Edit gagal");
    }

    // Mengeluarkan user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }

    // Memasukkan dan memberi akses user
    // (email, password)
    public function login(Request $request){
        $form_fields = $request->validate([
            'email' => ['required', 'email', 'digits_between:10,20'],
            'password' => ['required', 'string', 'digits_between:8,255'],
        ]);

        if(auth()->attempt($form_fields)){
            $request->session()->regenerate();

            return redirect("kelasku")->with("message", "Login berhasil");
        }

        return redirect()->back()->withErrors("Login gagal");
    }

    // Menghapus user
    // (id)
    public function delete(Request $request){
        User::query()
        ->where("id", "=", auth()->id())
        ->take(1)
        ->delete();

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
