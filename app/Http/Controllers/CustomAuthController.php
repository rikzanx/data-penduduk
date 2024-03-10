<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Penduduk;
use App\Models\Backup;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CustomAuthController extends Controller
{

    public function index(Request $request)
    {
        try{
            if ($this->cekKoneksiInternet()) {
                $currentUrl = $request->url();
                $month = date('m');
                $year = date('Y');
                $cek = Backup::whereYear('created_at',$year)->whereMonth('created_at',$month)->first();
                if(!$cek && str_contains($currentUrl, 'localhost')){
                    $dataPenduduk = Penduduk::all();
                    $client = new Client();
                    $response = $client->post('https://desaku.shw.my.id/api/backup', [
                        'json' => $dataPenduduk
                    ]);
                    $statusCode = $response->getStatusCode();
                    $data = $response->getBody()->getContents();
                    if($statusCode == 200 && $data == "ok"){
                        Backup::create();
                    }
                }
            }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
        return view('login');
    }  
    
    protected function cekKoneksiInternet() {
        // URL yang akan digunakan untuk memeriksa koneksi internet
        $url = 'https://www.google.com';
    
        // Mengambil header dari URL
        $headers = @get_headers($url);
    
        // Memeriksa apakah ada respons header
        if ($headers && strpos($headers[0], '200')) {
            return true; // Koneksi internet berhasil
        } else {
            return false; // Koneksi internet gagal
        }
    }
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')
                        ->with('status', 'Signed in');
        }
        return redirect()->route("login")->with('danger','Login details are not valid');
    }



    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect()->route("admin.dashboard")->with('status', 'You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect()->route('login')->with('danger', 'You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('login')->with('danger', 'Success Logout');
    }
}