<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Rw;
use App\Models\Rt;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Backup;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $rws = Rw::get();
        $rts = Rt::get();
        $penduduks = Penduduk::with('anggotas')->get();
        return view('admin.penduduk',[
            'rws' => $rws,
            'rts' => $rts,
            'penduduks' => $penduduks
        ]);
    }

    public function handle_backup(Request $request){
        try{
            $jsonData = json_encode($request->all());
            $today = date("Y-m-d H-i-s");
            $file_name = 'data-backup_'.$today.'.json';
            $filePath = public_path('data/'.$file_name);
            file_put_contents($filePath,$jsonData);

            $penduduks = $request->all();
            try{
                foreach($penduduks as $item){
                    $penduduk = Penduduk::where('nik',$item['nik'])->first();
                    if(!$penduduk){
                        $penduduk = new Penduduk();
                    }
                    $penduduk->nik = $item['nik'];
                    $penduduk->nkk = $item['nkk'];
                    $penduduk->nama = Str::upper($item['nama']);
                    $penduduk->tempat_lahir = Str::upper($item['tempat_lahir']);
                    $penduduk->tanggal_lahir = $item['tanggal_lahir'];
                    $penduduk->jenis_kelamin = $item['jenis_kelamin'];
                    $penduduk->rw = $item['rw'];
                    $penduduk->rt = $item['rt'];
                    $penduduk->alamat = Str::upper($item['alamat']);
                    $penduduk->agama = $item['agama'];
                    $penduduk->pekerjaan = Str::upper($item['pekerjaan']);
                    $penduduk->save();
                }
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                return $e->getMessage();
            }

            if(file_exists($filePath)){
                return 'ok';
            }else{
                return 'is not ok';
            }
            // return $request[0]['id']
        }catch(\Exception $e){
            return $e->getMessage();
        }
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:255',
            'nkk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'rw' => 'required',  
            'rt' => 'required',  
            'alamat' => 'required',  
            'agama' => 'required',  
            'pekerjaan' => 'required',  
        ]);

        if($validator->fails()){
            return redirect()->route("penduduk.index")->with('danger', $validator->errors()->first());
        }
        DB::beginTransaction();
        try{
            $cek = Penduduk::where('nik',$request->nik)->first();
            if($cek){
                DB::rollback();
                $ea = "NIK Sudah dipakai";
                return redirect()->route("penduduk.index")->with('danger', $ea);
            }

            $penduduk = new Penduduk();
            $penduduk->nik = $request->nik;
            $penduduk->nkk = $request->nkk;
            $penduduk->nama = Str::upper($request->nama);
            $penduduk->tempat_lahir = Str::upper($request->tempat_lahir);
            $penduduk->tanggal_lahir = $request->tanggal_lahir;
            $penduduk->jenis_kelamin = $request->jenis_kelamin;
            $penduduk->rw = $request->rw;
            $penduduk->rt = $request->rt;
            $penduduk->alamat = Str::upper($request->alamat);
            $penduduk->agama = $request->agama;
            $penduduk->pekerjaan = Str::upper($request->pekerjaan);
            $penduduk->created_by = Auth::user()->name;
            $penduduk->save();
            DB::commit();
            return redirect()->route("penduduk.index")->with('status', "Sukses menambahkan penduduk");
        }catch(\Exception $e){
            DB::rollback();
            $ea = "Terjadi Kesalahan saat menambahkan penduduk: ".$e->getMessage();
            return redirect()->route("penduduk.index")->with('danger', $ea);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:255',
            'nkk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'rw' => 'required',  
            'rt' => 'required',  
            'alamat' => 'required',  
            'agama' => 'required',  
            'pekerjaan' => 'required',  
        ]);
        
        if($validator->fails()){
            return redirect()->route("penduduk.index")->with('danger', $validator->errors()->first());
        }
        DB::beginTransaction();
        try{
            $penduduk = Penduduk::findOrFail($id);
            $penduduk->nik = $request->nik;
            $penduduk->nkk = $request->nkk;
            $penduduk->nama = Str::upper($request->nama);
            $penduduk->tempat_lahir = Str::upper($request->tempat_lahir);
            $penduduk->tanggal_lahir = $request->tanggal_lahir;
            $penduduk->jenis_kelamin = $request->jenis_kelamin;
            $penduduk->rw = $request->rw;
            $penduduk->rt = $request->rt;
            $penduduk->alamat = Str::upper($request->alamat);
            $penduduk->agama = $request->agama;
            $penduduk->pekerjaan = Str::upper($request->pekerjaan);
            $penduduk->save();
            DB::commit();
            return redirect()->route("penduduk.index")->with('status', "Sukses mengedit penduduk");
        }catch(\Exception $e){
            DB::rollback();
            $ea = "Terjadi Kesalahan saat mengedit penduduk: ".$e->getMessage();
            return redirect()->route("penduduk.index")->with('danger', $ea);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Penduduk::destroy($id)){
            return redirect()->route("penduduk.index")->with('status', "Sukses menghapus penduduk");
        }else {
            return redirect()->route("penduduk.index")->with('danger', "Terjadi Kesalahan");
        }
    }
}
