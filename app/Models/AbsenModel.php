<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenModel extends Model
{
    
    protected $table = 'db_absensiswa';
    protected $primaryKey = 'id_absensiswa';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_absensiswa',
        'id_tahunpelajaran',
        'id_kelas',
        'id_siswa',
        'tanggal',
        'keterangan',
        'keterangan2',
    ];
    
}
