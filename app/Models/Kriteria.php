<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';

    protected $fillable = ['kode_kriteria', 'keterangan', 'bobot', 'jenis'];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_kriteria');
    }
}
