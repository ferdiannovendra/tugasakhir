<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;
use Maatwebsite\Excel\Facades\Excel;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alldata =  DB::table('tenants')->get();
        $count =  DB::table('tenants')->count();
        // return $count;
        return view('super-admin.index',["data"=>$alldata,"count"=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function simpan_data_sekolah(Request $request)
    {
        $tenant = new Tenant();
        $tenant->name = $request->name;
        $tenant->npsn = $request->npsn;
        $tenant->save();
        return redirect()->route('superadminhome');
    }
    public function detailsekolah($id)
    {
        $tenant = Tenant::find($id);
        return view('super-admin.detailsekolah',["data"=>$tenant]);
    }
    public function simpanubah_tenant(Request $request, $id)
    {
        $tenant = Tenant::find($id);
        $tenant->name = $request->name;
        $tenant->npsn = $request->npsn;
        $tenant->database = $request->database;
        $tenant->domain = $request->domain;
        $tenant->start_date = $request->start_date;
        $tenant->end_date = $request->end_date;
        $tenant->save();

        return redirect()->route('superadminhome');
    }
    public function generateDB(Request $request)
    {
        $tenant = Tenant::find($request->id);
        $newSchema = 'tenancy'.$tenant->name;
        $sql = "create database ".$newSchema;
        $result = DB::statement($sql);
        // url('/uploads/images/'.$mostafid->imageM);

        $restore_file  = public_path('db/db.sql');
        $server_name   = env('DB_HOST');
        $username      = env('DB_USERNAME');
        $password      = env('DB_PASSWORD');


        // $cmd = "mysql -h ".$server_name." -u ".$username." ". $newSchema. " < ../../../public/".$restore_file;
        $cmd = "mysql -h ".$server_name." -u ".$username." ". $newSchema. " < ".$restore_file;
        $run = exec($cmd);
        // return $cmd;

        if ($run) {
            return response()->json([
                'status' => 'sukses'
            ]);
        }else{
            return response()->json([
                'status' => $cmd
            ]);
        }

    }
    public function validateNPSN($id)
    {
        $npsn = " ".$id;
        $output = shell_exec(escapeshellcmd('python '.public_path("/python/cek.py").$npsn));
        // $output = 'python '.public_path("/python/cek.py").$npsn;
        echo $output;
    }

}
