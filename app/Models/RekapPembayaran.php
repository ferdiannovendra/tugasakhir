<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapPembayaran extends Model
{
    use HasFactory;
    protected $table="rekap_keuangan";
    protected $primaryKey = "idrekap_keuangan";
}
