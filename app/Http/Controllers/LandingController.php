<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.landing.index');
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

    public function login(Request $request)
    {
        if($request->role == 1){
            $check = DB::table('kios')
                ->select()
                ->where('username', $request->username)
                ->where('password', $request->password)
                ->get();
            if(count($check) != 0){
                //Get id
                foreach($check as $c){
                    $id = $c->id;
                    $profilepic = $c->kios_image_url;
                }

                $request->session()->put('idKey', $id);
                $request->session()->put('usernameKey', $request->username);
                $request->session()->put('passwordKey', $request->password);
                $request->session()->put('profile_pic_kios', $profilepic);
                $request->session()->put('role', 'kios');

                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('failed_message', 'Username atau password Anda salah');
            }   
        } else if($request->role == 2){
            $check = DB::table('karyawan')
                ->select()
                ->where('username_karyawan', $request->username)
                ->where('password_karyawan', $request->password)
                ->get();
            if(count($check) != 0){
                //Get id
                foreach($check as $c){
                    $id = $c->id_kios;
                    $id_karyawan = $c->id;
                    $profilepic = $c->karyawan_image_url;
                }

                $request->session()->put('idKey', $id);
                $request->session()->put('idKaryawan', $id_karyawan);
                $request->session()->put('usernameKey', $request->username);
                $request->session()->put('passwordKey', $request->password);
                $request->session()->put('profile_pic_kios', $profilepic);
                $request->session()->put('role', 'karyawan');

                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('failed_message', 'Username atau password Anda salah');
            }   
        }
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
}
