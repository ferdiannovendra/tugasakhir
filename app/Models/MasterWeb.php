<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MasterWeb extends Model
{
    use HasFactory;
    protected $table="master_web";

    public static function Kepsek()
    {
        $select = DB::table('setting')->join('users', 'kepala_sekolah', 'id')->first();
        return $select;
    }
}
