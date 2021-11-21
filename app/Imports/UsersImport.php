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
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
           $user = User::create([
               'name' => $row[0],
               'email'    => $row[6],
               'password' => Hash::make($row[7]),
           ]);
           Customer::create([
               'customer_name' => $row[0],
               'gender' => $row[1],
               'address' => $row[2],
               'city' => $row[3],
               'postal_code' => $row[4],
               'country' => $row[5],
           ]);
           $myString = $row[8];
           $myArray = explode(',', $myString);
           foreach ($myArray as $value) {
               Courses::create([
                    'user_id' => $user->id,
                    'course_name' => $value,
               ]);
           }
        }
    }

}
