<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_by'
    ];

    public function anggotas(){
        return $this->hasMany('App\Models\Penduduk','nkk','nkk');
    }
}