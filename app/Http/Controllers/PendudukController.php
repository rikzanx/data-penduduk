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

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rws = Rw::get();
        $rts = Rt::get();
        $penduduks = Penduduk::with('anggotas')->get();
        return view('admin.penduduk',[
            'rws' => $rws,
            'rts' => $rts,
            'penduduks' => $penduduks
        ]);
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

    public function handle_backup(Request $request){
        try{
            $jsonData = json_encode($request->all());
            $today = date("Y-m-d");
            $file_name = 'data-backup_'.$today.'.json';
            $filePath = public_path('data/'.$file_name);
    
            file_put_contents($filePath,$jsonData);
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
}
