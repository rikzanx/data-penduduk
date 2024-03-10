<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\User;
use App\Models\Rt;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc','#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8', '#6610f2', '#fd7e14', '#6f42c1', '#e83e8c', '#20c997'];
        $data = [];
        $data['jumlah_penduduk'] = Penduduk::count();
        $query = Penduduk::select('nkk')->groupBy('nkk')->get();
        $data['jumlah_keluarga'] = count($query);
        $data['jumlah_user'] = User::count();
        
        $rts = Rt::get();
        $label = [];
        $value = [];
        foreach($rts as $rt){
            $label[] = 'RT '.$rt->name;
            $query = Penduduk::select('rt')->groupBy('rt')->where('rt',$rt->name)->get();
            $value[] = count($query);
        }
        $jumlah_label = count($label);
        $data['sebaran_rt'] = [
            'labels' => $label,
            'datasets' => [
                [
                    'data' => $value,
                    'backgroundColor' => array_slice($colors, 0, $jumlah_label),
                ]
            ]
        ];

        $penduduk = Penduduk::get();

        $jenis_kelamin = array('L','P');
        $label = ['Laki-Laki','Perempuan'];
        $value = [];
        foreach($jenis_kelamin as $item){
            $query = $penduduk->filter(function($penduduk) use($item){
                return $penduduk->jenis_kelamin == $item;
            });
            $value[] = count($query);
        }
        $jumlah_label = count($label);
        $data['sebaran_jenis_kelamin'] = [
            'labels' => $label,
            'datasets' => [
                [
                    'data' => $value,
                    'backgroundColor' => array_slice($colors, 0, $jumlah_label),
                ]
            ]
        ];

        $variasi = array(
            array('min' => 0, 'max' => 4), //Bayi Dan Balita
            array('min' => 5, 'max' => 12), //Anak-anak
            array('min' => 13, 'max' => 19), //Remaja
            array('min' => 20, 'max' => 39), //Dewasa Muda
            array('min' => 40, 'max' => 59), //Dewasa Pertengahan
            array('min' => 60, 'max' => 79), //Lansia
            array('min' => 80, 'max' => 1000), //Lansia Lanjut
        );
        $label = ['Bayi Dan Balita (0-4 thn)','Anak-anak (5-12 thn)','Remaja (13-19 thn)','Dewasa Muda (20-39 thn)','Dewasa Pertengahan (40-59 thn)','Lansia (60-79 thn)','Lansia Lanjut (80+ thn)'];
        $value = [];
        foreach($variasi as $v){
            $query = $penduduk->filter(function($penduduk) use($v){
                return $penduduk->usia >= $v['min'] && $penduduk->usia <= $v['max'];
            });
            $value[] = count($query);
        }
        $jumlah_label = count($label);
        $data['sebaran_varasi_usia'] = [
            'labels' => $label,
            'datasets' => [
                [
                    'data' => $value,
                    'backgroundColor' => array_slice($colors, 0, $jumlah_label),
                ]
            ]
        ];
        return view('admin.dashboard',$data);
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
