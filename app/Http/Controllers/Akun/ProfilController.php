<?php

namespace App\Http\Controllers\Akun;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Kios;
use App\Models\Riwayat_Kios;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rak = DB::table('rak')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        $akun = DB::table('kios')
            ->where('id', session()->get('idKey'))->get();

        //Set active nav
        session()->put('active_nav', 'profil');

        return view ('admin.profil.index')
            ->with('rak', $rak)
            ->with('akun', $akun);
    }

    public function edit_akun(Request $request)
    {
        $count = 0;
        $username = $request->username;

        if($request->username != $request->username_old){
            $check = DB::table('kios')
                ->select()
                ->where('username', $request->username)
                ->get();
            
            $count = count($check);
            $username = $request->username_old;
        }
        
        if($count == 0){
            Kios::where('id', session()->get('idKey'))->update([
                'username' => $request->username,
                'password' => $request->password,
                'nama_kios' => $request->nama_kios,
                'alamat_kios' => $request->alamat_kios,
                'kontak_kios' => $request->kontak_kios,
                'email_kios' => $request->email_kios,
                'deskripsi_kios' => $request->deskripsi_kios,
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            Riwayat_Kios::create([
                'id_kios' => session()->get('idKey'),
                'konteks_riwayat' => 'Akun Kios',
                'deskripsi_riwayat' => 'mengubah data akun',
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('success_message', 'Berhasil mengubah data akun');
        } else {
            return redirect()->back()->with('failed_message', 'Gagal mengubah data, pastikan data telah diisi dengan benar');
        }
    }

    public function edit_status(Request $request, $status)
    {
        if($status == "non-aktif"){
            //Status json config.
            if($request->date_start == null ){
                $date_start = date("Y-m-d");
            } else {
                $date_start = $request->date_start;
            }
            
            $old['status'] = $status; 
            $old['date_start'] = $date_start; 
            $old['date_end'] = $request->date_end;
        
            $new = json_encode($old); 

            Kios::where('id', session()->get('idKey'))->update([
                'status_akun_kios' => $new,
                'updated_at' => date("Y-m-d h:m:i"),
            ]);
            
            //History.
            Riwayat_Kios::create([
                'id_kios' => session()->get('idKey'),
                'konteks_riwayat' => 'Akun Kios',
                'deskripsi_riwayat' => 'menon-aktifkan akun',
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('deactivate_message', 'Akun berhasil dinon-aktifkan. Selamat beristirahat dan sampai jumpa');
        } else {
            //Status json config.
            $old['status'] = $status; 
            $old['date_start'] = null; 
            $old['date_end'] = null; 
        
            $new = json_encode($old); 

            Kios::where('id', session()->get('idKey'))->update([
                'status_akun_kios' => $new,
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            //History.
            Riwayat_Kios::create([
                'id_kios' => session()->get('idKey'),
                'konteks_riwayat' => 'Akun Kios',
                'deskripsi_riwayat' => 'mengaktifkan akun',
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('activate_message', 'Akun berhasil diaktifkan kembali. Selamat datang');
        }
    }

    public function edit_foto(Request $request)
    {
        $kios_id = DB::table('kios')->where('id', session()->get('idKey'))->get();
        //Get old image url.
        foreach($kios_id as $kr){
            $old_image = $kr->kios_image_url;
        }

        //Validate image.
        $this->validate($request, [
            'image_url'     => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        //Upload image.
        $new_image = $request->file('image_url');
        $new_image->storeAs('public', $new_image->hashName());
        $imageURL = $new_image->hashName();

        //Delete old image if new image is uploaded.
        if(($request->file('image_url')->isValid())&&($old_image != "null")){
            Storage::delete('public/'.$old_image);
        }

        Kios::where('id', session()->get('idKey'))->update([
            'kios_image_url' => $imageURL,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        //History.
        Riwayat_Kios::create([
            'id_kios' => session()->get('idKey'),
            'konteks_riwayat' => 'Akun Kios',
            'deskripsi_riwayat' => 'mengganti foto profil',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Foto profil berhasil diperbarui');
    }

    public function reset_foto(Request $request)
    {
        $kios_id = DB::table('kios')->where('id', session()->get('idKey'))->get();
        //Get old image url.
        foreach($kios_id as $kr){
            $old_image = $kr->kios_image_url;
        }

        //Delete old image.
        if($old_image != null){
            Storage::delete('public/'.$old_image);
        }

        Kios::where('id', session()->get('idKey'))->update([
            'kios_image_url' => null,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        //History.
        Riwayat_Kios::create([
            'id_kios' => session()->get('idKey'),
            'konteks_riwayat' => 'Akun Kios',
            'deskripsi_riwayat' => 'mereset foto profil',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Foto profil berhasil direset');
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
