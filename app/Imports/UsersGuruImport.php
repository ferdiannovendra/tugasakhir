<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersGuruImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $user = new User();
            $user->nik = $row['nik'];
            $user->name = $row['name'];
            $user->lname = $row['lname'];
            $user->email = $row['email'];
            $user->password = Hash::make($row['password']);
            $user->address = $row['address'];
            $user->phone = $row['phone'];
            $user->status = 'guru';
            $user->religion = $row['religion'];
            $user->gender = $row['gender'];
            $user->birth_place = $row['birth_place'];
            $user->birth_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birth_date']);
            $user->save();
        }
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
