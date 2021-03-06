<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $primaryKey = "idmata_pelajaran";
    protected $table="mata_pelajaran";

    public function user()
    {
        return $this->belongsTo(User::class,'guru_pengajar', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriMapel::class,'id_kategori', 'id');
    }
    public function kompetensidasar()
    {
        return $this->hasMany(KompetensiDasar::class,'idmata_pelajaran','idmata_pelajaran');
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'jadwal_kelas', 'idmatapelajaran', 'idclass_list');
    }
    public function bobot()
    {
        return $this->belongsToMany(Kelas::class,'bobot_nilai_akhir','idmata_pelajaran','idclass_list')->withPivot('bobot_pengetahuan','bobot_keterampilan');
    }

}
