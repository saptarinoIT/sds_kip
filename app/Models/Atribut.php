<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribut extends Model
{
    use HasFactory;
    protected $table        = 'atribut';
    protected $fillable     = ['kriteria_id', 'nama_atribut', 'nilai_atribut'];
    protected $hidden       = ['created_at', 'updated_at'];
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
    // public function nilai()
    // {
    //     return $this->belongsTo(NilaiAlternatif::class);
    // }
}
