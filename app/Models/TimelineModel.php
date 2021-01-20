<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineModel extends Model
{
    
    protected $table = 'db_jadwalkegiatan';
    protected $primaryKey = 'id_jadwalkegiatan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_jadwalkegiatan',
        'id_tahunpelajaran',
        'nama_jadwalkegiatan',
        'waktu',
        'nama_tempat',
        'alamat',
        'catatan',
    ];
    
}
