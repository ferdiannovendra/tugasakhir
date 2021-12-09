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
        return $this->hasMany(KompetensiDasar::class);
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'jadwal_kelas', 'idmatapelajaran', 'idclass_list');
    }

}
