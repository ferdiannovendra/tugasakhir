<?php

namespace App\Imports;

use App\Models\User;
use App\Models\DetailSiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new User([
    //         //
    //     ]);
    // }
    public function model(array $row)
    {
        return $user = User::create([
            'nik' => $row['nik'],
            'name'    => $row['name'],
            'lname'    => $row['lname'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
            'address'    => $row['address'],
            'phone'    => $row['phone'],
            'status'    => 'siswa',
            'religion'    => $row['religion'],
            'gender'    => $row['gender'],
            'birth_place'    => $this->transformDate($row['brith_place']),
            'birth_date'    => $this->transformDate($row['birth_date']),
         ]);
        // foreach ($rows as $row)
        // {

        //     // $user = new User();
        //     // $user->nik = $row['nik'];
        //     // $user->name = $row['name'];
        //     // $user->lname = $row['lname'];
        //     // $user->email = $row['email'];
        //     // $user->password = Hash::make($row['password']);
        //     // $user->address = $row['address'];
        //     // $user->phone = $row['phone'];
        //     // $user->status = 'siswa';
        //     // $user->religion = $row['religion'];
        //     // $user->gender = $row['gender'];
        //     // $user->birth_place = $row['birth_place'];
        //     // $user->birth_date = $row['birth_date'];
        //     // $user->save();

        //     // $iduser = $user->id;

        //     // $detail = new DetailSiswa();
        //     // $detail->idusers = $iduser;
        //     // $detail->nis = $row['nis'];
        //     // $detail->nisn = $row['nisn'];
        //     // $detail->status_dalam_keluarga = $row['status_dalam_keluarga'];
        //     // $detail->anak_ke = $row['anak_ke'];
        //     // $detail->sekolah_asal = $row['sekolah_asal'];
        //     // $detail->kelas_masuk = $row['kelas_masuk'];
        //     // $detail->save();
        // //    $myString = $row[8];
        // //    $myArray = explode(',', $myString);
        // //    foreach ($myArray as $value) {
        // //        Courses::create([
        // //             'user_id' => $user->id,
        // //             'course_name' => $value,
        // //        ]);
        // //    }
        // }
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

}
