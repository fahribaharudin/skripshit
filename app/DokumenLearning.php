<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenLearning extends Model
{
    protected $fillable = [
        'class',
        'jumlah_organisasi',
        'waktu_berorganisasi',
        'sudah_kp_atau_kpm',
        'event_organisasi_tiap_semester',
        'jadi_panitia',
        'makul_belum_tuntas',
        'sks_cukup',
        'ingin_lulus_tepat_waktu'
    ];

    public $timestamps = false;
}
