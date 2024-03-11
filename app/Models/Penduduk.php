<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Penduduk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'nkk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kecataman',
        'kelurahan',
        'rw',
        'rt',
        'alamat',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'status_hubungan',
        'keterangan', //meninggal,pindah,
        'created_by'
    ];

    protected $appends = ['usia'];

    public function getUsiaAttribute()
    {
        // Ambil tanggal lahir dari model
        $tanggal_lahir = $this->tanggal_lahir;

        // Hitung usia menggunakan Carbon
        if ($tanggal_lahir) {
            return Carbon::parse($tanggal_lahir)->age;
        }

        return null;
    }

    public function anggotas(){
        return $this->hasMany('App\Models\Penduduk','nkk','nkk');
    }
}