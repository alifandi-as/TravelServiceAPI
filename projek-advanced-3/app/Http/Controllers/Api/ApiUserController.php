<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ExtApiController;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends ExtApiController
{
     // Mendapatkan semua user
    public function index(){
        $users = User::query()
                ->get()
                ->toArray();
        return $this->send_success("Data para pengguna:", $users);
    }

     // Menampilkan sebuah user berdasarkan id
     // (id)
    public function show(){
        $users = User::find(auth()->id());
        if ($users == null){
            return $this->send_bad_request("Tidak ada user dengan id ini");
        }
        return $this->send_success("Data pengguna Anda adalah:", $users);
    }

    // Mencari user berdasarkan kueri pencarian
    // (q (kueri pencarian))
    public function search(Request $request){
 
        $search = $request->name;

        // mengambil data dari table pegawai sesuai pencarian data
        $users = DB::table('users')
        ->select('id', 'name', 'email', 'created_at', 'updated_at')
        ->where('name','like',"%".$search."%")
        ->get()
        ->toArray();

        // mengirim data pegawai ke view index
        return $this->send_success("Hasil pencarian:", $users);
    }
    
    // Memasukkan dan memberi akses user
    // (email, password)
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'email:strict'],
            'password' => ['required', 'string', 'digits_between:8,255'],
        ]);

        if ($validator->fails()){
            return $this->send_fail("Kredensial tidak memenuhi syarat: {$validator->errors()}");
        }
        
        $form_fields = $validator->validated();
        if(auth()->attempt($form_fields)){
            $user = User::where("id", auth()->user()->id);
            $token = $user->firstOrFail()->createToken("auth-token")->plainTextToken;
            $user_data = $user->get()->toArray()[0];
            

            return $this->send_success("Berhasil login", ["user_data" => $user_data, "token" => $token]);
        }

        return $this->send_fail("Kredensial salah");
    }
    
    // Mendaftar user dan menambah user ke database
    // (name, email, image, password, password confirmation)
    public function register(Request $request){

        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,bmp,tif,tiff,webp,avif', 'dimensions:max_width=4096,max_height=`4096'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        /*
        $request->validate([
            'name' => 'required|string|max_digits:255',
            'email' => ['required', 'email', 'max_digits:255', 'unique:users,email'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,bmp,tif,tiff,webp,avif', 'dimensions:max_width=4096,max_height=`4096'],
            'password' => ['required', 'string', 'digits_between:8,255', 'confirmed'],
        ]);
        */

        if ($validator->fails()){
            return $this->send_fail($validator->errors());
        }

        $fields = $validator->validated();
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
            return $this->send_success("Registrasi berhasil", $user);
        }
        else{
            return $this->send_fail("Gagal mengunggah gambar");
        }
        
    }

    // Mengubah profil user
    // (name)
    public function edit_profile(Request $request){
            $validator = Validator::make($request->all(), [
                
                'name' => 'required|string|max_digits:255',
            ]);
            if ($validator->fails()){
                return $this->send_fail("Gagal mengedit profil", $validator->errors());
            }

            $form_fields = $validator->validated();
            if (file_exists(url("/uploads/profile_pic/".auth()->user()->name)))
            {
                rename(public_path("/images/player_icons/".auth()->user()->name), public_path('/images/player_icons/'.$form_fields["name"]));
            }
            User::query()
                ->where("id", "=", auth()->id())
                ->update($form_fields);
            $request->session()->regenerate();
            clearstatcache();
            return $this->send_success("Profil berhasil diubah");
    }

    // Mengubah password user
    // (name, email, old password, new password, new password confirmation)
    public function edit_password(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max_digits:255',
            'email' => ['required', 'email:strict', 'unique:users,email'],
            'old_password' => ['required', 'string', 'digits_between:8,255'],
            'new_password' => ['required', 'string', 'digits_between:8,255', 'confirmed'],
        ]);

        if ($validator->fails()){
            return $this->send_fail("Edit password gagal", $validator->errors());
        }
        $form_fields = $validator->validated();
        $prior_form_fields = ['name' => $form_fields["name"],
                            'email' => $form_fields["email"],
                            'password' => $form_fields["old_password"]];
        // dd($prior_form_fields['password']);
        // Hash password
        

        if(auth()->attempt($prior_form_fields)){
            
            $form_fields['new_password'] = bcrypt($form_fields['new_password']);
            User::query()
                ->where("id", "=", auth()->id())
                ->update(["password" => $form_fields["new_password"]]);
            $request->session()->regenerate();
            return $this->send_success("Edit berhasil");
        }
        return $this->send_fail("Edit gagal karena password lama tidak cocok");
    }

    // Mengeluarkan user
    public function logout(){
        // Revoke the token that was used to authenticate the current request...
        // Pakai ini karena $request->user()->currentAccessToken()->delete(); tidak bisa
        auth('sanctum')->user()->currentAccessToken()->delete();

        return $this->send_success("Berhasil logout");
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
