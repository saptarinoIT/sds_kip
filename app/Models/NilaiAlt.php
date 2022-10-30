<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlt extends Model
{
    use HasFactory;
    protected $table        = 'nilai_alt';
    // public function atribut()
    // {
    //     return $this->belongsTo(Atribut::class, 'atribut_id');
    // }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id');
    }
}
