<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table        = 'alternatif';
    protected $fillable     = [
        'user_id',
        'kode_alternatif',
        'jenjang',
        'nama',
        'alamat',
        'asal_sekolah',
        'universitas',
        'fakultas',
        'jurusan',
        'nama_ayah',
        'nama_ibu',
        'nama_wali',
        'pek_ayah',
        'pek_ibu',
        'pek_wali',
        'peng_ayah',
        'peng_ibu',
        'peng_wali',
        'pangan',
        'sandang',
        'pdam',
        'listrik',
        'internet',
        'pulsa',
        'transportasi',
        'cicilan',
        'sewa_rumah',
        'keterangan',
        'tahun',
    ];
    // public function atribut()
    // {
    //     return $this->belongsToMany(Atribut::class, 'nilai_alternatif', 'alternatif_id', 'atribut_id');
    // }
    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class, 'nilai_alternatif', 'alternatif_id', 'kriteria_id');
    }
    public function nilai()
    {
        return $this->hasMany(NilaiAlternatif::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
