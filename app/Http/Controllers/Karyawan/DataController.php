<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Karyawan;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //All rak.
        $rak = DB::table('rak')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        $karyawan = DB::table('karyawan')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        //Set active nav
        session()->put('active_nav', 'karyawan');

        return view ('admin.karyawan.data.index')
            ->with('rak', $rak)
            ->with('karyawan', $karyawan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_karyawan(Request $request)
    {
        //Create Account validator
        $validator = Validator::make($request->all(), [
            'nama_karyawan' => 'required|max:15|min:4',
            'nama_lengkap_karyawan' => 'required|max:35',
            'email_karyawan' => 'required|max:50|email|min:11|unique:karyawan',
            'ponsel_karyawan' => 'required|max:16',
            'jabatan_karyawan' => 'required',
            'status_karyawan' => 'required',
            'gaji_karyawan' => 'required',
            'image_url' => 'required',
        ]);
        
        if (!$validator->fails()) {
            //Check username avaiability
            $check = DB::table('karyawan')
                ->select()
                ->where('nama_karyawan', $request->nama_karyawan)
                ->get();

            //Validate image
            $this->validate($request, [
                'image_url'     => 'required|image|mimes:jpeg,png,jpg|max:5000',
            ]);

            //Upload image
            $image = $request->file('image_url');
            $image->storeAs('public', $image->hashName());
            $imageURL = $image->hashName();

            if(count($check) == 0){
                //Karyawan data.
                Karyawan::create([
                    'id_kios' => session()->get('idKey'),
                    'nama_karyawan' => $request->nama_karyawan,
                    'nama_lengkap_karyawan' => $request->nama_lengkap_karyawan,
                    'email_karyawan' => $request->email_karyawan,
                    'ponsel_karyawan' => $request->ponsel_karyawan,
                    'jabatan_karyawan' => $request->jabatan_karyawan,
                    'status_karyawan' => $request->status_karyawan,
                    'gaji_karyawan' => $request->gaji_karyawan,
                    'karyawan_image_url' => $imageURL,
                    'created_at' => date("Y-m-d h:m:i"),
                    'updated_at' => date("Y-m-d h:m:i"),
                ]);

                return redirect()->back()->with('success_message', 'Berhasil menambahkan karyawan baru');
            } else {
                return redirect()->back()->with('failed_message', 'Validasi gagal!, periksa kembali data Anda');
            }
        } else {
            return redirect()->back()->with('failed_message', 'Validasi gagal!, periksa kembali data Anda');
        }        
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

    public function edit_foto(Request $request, $id)
    {
        $karyawan_id = DB::table('karyawan')->where('id', $id)->get();
        //Get old image url.
        foreach($karyawan_id as $kr){
            $old_image = $kr->karyawan_image_url;
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

        Karyawan::where('id', $id)->update([
            'karyawan_image_url' => $imageURL,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Foto profil berhasil diperbarui');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_karyawan(Request $request, $id)
    {
        Karyawan::where('id', $id)->update([
            'nama_karyawan' => $request->nama_karyawan,
            'nama_lengkap_karyawan' => $request->nama_lengkap_karyawan,
            'email_karyawan' => $request->email_karyawan,
            'ponsel_karyawan' => $request->ponsel_karyawan,
            'gaji_karyawan' => $request->gaji_karyawan,
            'jabatan_karyawan' => $request->jabatan_karyawan,
            'status_karyawan' => $request->status_karyawan,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Data karyawan berhasil diperbarui');
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
    public function delete_karyawan($id)
    {
        Karyawan::destroy($id);

        //Delete others karyawan relation
        DB::table('absensi')->where('id_karyawan', '=', $id)->delete();
        DB::table('relasi_kasir')->where('id_karyawan', '=', $id)->delete();

        return redirect()->back()->with('success_message', 'Karyawan berhasil dihapus');
    }
}
