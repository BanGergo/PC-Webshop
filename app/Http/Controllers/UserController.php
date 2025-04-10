<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function regData(Request $req){
        $req->validate([
            'nev' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()],
            'password_confirmation' => 'required'

        ],[
            'nev.required' => "A nevet kötelező megadni!",
            'email.required' => "Az emailt kötelező megadni!",
            'email.unique' => 'Ez az e-mail cím már foglalt!',
            'password.required' => "A jelszót kötelező megadni!",
            'password.min' => 'A jelszó legalább 8 karakter legyen!',
            'password.letters' => 'Adjon meg betűt is!',
            'password.numbers' => 'Adjon meg számot is!',
            'password.mixed' => 'Adjon meg nagy és kis betűt is egyaránt',
            'password.confirmed' => 'Nem egyezik meg a két jelszó!',
            'password_confirmation.required' => "A jelszót kötelező megadni!"
        ]);

        $data = new User;
        $data->username = $req->nev;
        $data->email = $req->email;
        $data->password = Hash::make($req->password);
        $data->status = 1;
        $data->Save();

        return redirect('/')->withErrors(['sv' => 'Sikeresen regisztráltál']);
    }

    public function loginData(Request $req){
        $req->validate([
            'login_email' => 'required',
            'login_password' => 'required'
        ],[
            'login_email.required' => "Az emailt kötelező megadni!",
            'login_password.required' => "A jelszót kötelező megadni!"
        ]);
        if(Auth::attempt(['email' => $req->login_email, 'password' => $req->login_password])){
            return redirect('/')->withErrors(['sv' => 'Sikeresen belépett!']);
        }else {
            return redirect('/')->withErrors(['sv' => 'Nem sikerült belépni!']);
        }
    }

    public function mod(){
        if(Auth::check()){
            return view('mod');
        } else {
            return redirect('/login', [
                'sv' => 'Kérem lépjen be!'
            ]);
        }
    }

    public function passMod(Request $req){
        $req->validate([
            'old_pass'                  => 'required',
            'new_pass'                  => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()],
            'new_pass_confirmation'     => 'required',
        ],[
            'old_pass.required'         => 'Kötelező megadni',
            'new_pass.required'         => 'Kötelező megadni!',
            'new_pass.confirmed'        => 'Nem egyezik meg a két jelszó!',
            'new_pass.min'              => 'A jelszó legalább 8 karakter legyen!',
            'new_pass_confirmation.required' => 'Kötelező megadni!'
        ]);

        if(Hash::check($req->old_pass, Auth::user()->password)){
            $data           = User::find(Auth::user()->user_id);
            $data->password = Hash::make($req->new_pass);
            $data->Save();
            return redirect('/')->withErrors(['sv' => 'Sikeres jelszó módosítás!']);
        } else {
            return redirect('/mod')->withErrors(['sv' => 'Nem sikerült módosítania!']);
        }
    }
}
