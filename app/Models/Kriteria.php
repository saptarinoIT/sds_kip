<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table        = 'kriteria';
    protected $fillable     = ['kode_kriteria', 'nama_kriteria', 'bobot'];
    protected $hidden       = ['created_at', 'updated_at'];
    public function atribut()
    {
        return $this->hasMany(Atribut::class);
    }
    public function nilai()
    {
        return $this->hasMany(NilaiAlternatif::class);
    }
}
