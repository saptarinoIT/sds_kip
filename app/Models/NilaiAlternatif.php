<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    use HasFactory;
    protected $table        = 'nilai_alternatif';
    protected $fillable     = ['alternatif_id', 'kriteria_id', 'nilai'];
    // public function atribut()
    // {
    //     return $this->belongsTo(Atribut::class, 'atribut_id');
    // }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
}
