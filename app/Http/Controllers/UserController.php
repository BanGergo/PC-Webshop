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

    public function modData(Request $req){
        $req->validate([
            'opassword'                  => 'required',
            'npassword'                  => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()],
            'npassword_confirmation'     => 'required',
        ],[
            'opassword.required'         => 'Kötelező megadni',
            'npassword.required'         => 'Kötelező megadni!',
            'npassword.confirmed'        => 'Nem egyezik meg a két jelszó!',
            'npassword.min'              => 'A jelszó legalább 8 karakter legyen!',
            'npassword_confirmation.required' => 'Kötelező megadni!'
        ]);

        if(Hash::check($req->opassword, Auth::user()->password)){
            $data           = User::find(Auth::user()->users_id);
            $data->password = Hash::make($req->npassword);
            $data->Save();
            return redirect('/')->withErrors(['sv' => 'Sikeres jelszó módosítás!']);
        } else {
            return redirect('/mod')->withErrors(['sv' => 'Nem sikerült módosítania!']);
        }
    }
}
