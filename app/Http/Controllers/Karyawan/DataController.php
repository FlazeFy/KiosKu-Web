<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Karyawan;
use App\Models\Tandai;
use App\Models\Jabatan;
use App\Models\Riwayat_Kios;

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

        $jabatan = DB::table('jabatan')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        $karyawan = Karyawan::leftJoin("tandai", function ($join) {
            $join->on("karyawan.id", "=", "tandai.id_context")
            ->where('tandai.type_context', 'karyawan');
            })
            ->select('karyawan.id', 'karyawan.nama_karyawan', 'karyawan.nama_lengkap_karyawan', 'karyawan.ponsel_karyawan', 'karyawan.email_karyawan', 'karyawan.jabatan_karyawan', 'karyawan.gaji_karyawan', 'karyawan.updated_at', 'karyawan.status_karyawan', 'karyawan.karyawan_image_url', 'tandai.id_tandai', 'tandai.id_context', 'tandai.type_context')
            ->where('karyawan.id_kios', session()->get('idKey'))
            ->groupBy('karyawan.id')
            ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai')
            ->get();

        //Set active nav
        session()->put('active_nav', 'karyawan');

        return view ('admin.karyawan.data.index')
            ->with('rak', $rak)
            ->with('karyawan', $karyawan)
            ->with('jabatan', $jabatan);
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
        ]);

        //Check username avaiability
        $check = DB::table('karyawan')
            ->select()
            ->where('nama_karyawan', $request->nama_karyawan)
            ->get();
        
        if (!$validator->fails()) {
            if($request->hasFile('image_url')){
                //Validate image
                $this->validate($request, [
                    'image_url'     => 'required|image|mimes:jpeg,png,jpg|max:5000',
                ]);

                //Upload image
                $image = $request->file('image_url');
                $image->storeAs('public', $image->hashName());
                $imageURL = $image->hashName();
            } else {
                $imageURL = null;
            }

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

                //History.
                Riwayat_Kios::create([
                    'id_kios' => session()->get('idKey'),
                    'konteks_riwayat' => 'Akun Karyawan',
                    'deskripsi_riwayat' => 'menambahkan karyawan '.$request->nama_lengkap_karyawan.'',
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
    public function unpin($id)
    {
        Tandai::destroy($id);
        return redirect()->back()->with('success_message', 'Pin dilepaskan');
    }

    public function pin($id)
    {
        Tandai::create([
            'id_kios' => session()->get('idKey'),
            'id_context' => $id,
            'type_context' => 'karyawan',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Item ditandai');
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
        if(($request->file('image_url')->isValid())&&($old_image != null)){
            Storage::delete('public/'.$old_image);
        }

        Karyawan::where('id', $id)->update([
            'karyawan_image_url' => $imageURL,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        //History.
        Riwayat_Kios::create([
            'id_kios' => session()->get('idKey'),
            'konteks_riwayat' => 'Akun Karyawan',
            'deskripsi_riwayat' => 'mengganti foto profil '.$request->nama_lengkap_karyawan.'',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Foto profil berhasil diperbarui');
    }

    public function reset_foto(Request $request, $id)
    {
        $karyawan_id = DB::table('karyawan')->where('id', $id)->get();
        //Get old image url.
        foreach($karyawan_id as $kr){
            $old_image = $kr->karyawan_image_url;
        }

        //Delete old image.
        if($old_image != null){
            Storage::delete('public/'.$old_image);
        }

        Karyawan::where('id', $id)->update([
            'karyawan_image_url' => null,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        //History.
        Riwayat_Kios::create([
            'id_kios' => session()->get('idKey'),
            'konteks_riwayat' => 'Akun Karyawan',
            'deskripsi_riwayat' => 'mengganti foto profil '.$request->nama_lengkap_karyawan.'',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Foto profil berhasil direset');
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

        //History.
        Riwayat_Kios::create([
            'id_kios' => session()->get('idKey'),
            'konteks_riwayat' => 'Akun Karyawan',
            'deskripsi_riwayat' => 'mengedit profil '.$request->nama_lengkap_karyawan.'',
            'created_at' => date("Y-m-d h:m:i"),
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
    public function tambah_jabatan(Request $request)
    {
        //Check name availability.
        $check = DB::table('jabatan')
            ->select()
            ->where('id_kios', session()->get('idKey'))
            ->where('nama_jabatan', $request->nama_jabatan)
            ->get();

        if(count($check) == 0){
            Jabatan::create([
                'id_kios' => session()->get('idKey'),
                'nama_jabatan' => $request->nama_jabatan,
                'deskripsi_jabatan' => $request->deskripsi_jabatan,
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i")
            ]);

            //History.
            Riwayat_Kios::create([
                'id_kios' => session()->get('idKey'),
                'konteks_riwayat' => 'Akun Karyawan',
                'deskripsi_riwayat' => 'menambah jabatan '.$request->nama_jabatan.'',
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('success_message', 'Jabatan berhasil ditambahkan');
        } else {
            return redirect()->back()->with('failed_message', 'Tambah jabatan gagal. Gunakan nama jabatan yang unik');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_karyawan(Request $request, $id)
    {
        Karyawan::destroy($id);

        //Delete others karyawan relation
        DB::table('absensi')->where('id_karyawan', '=', $id)->delete();
        DB::table('relasi_kasir')->where('id_karyawan', '=', $id)->delete();

        //History.
        Riwayat_Kios::create([
            'id_kios' => session()->get('idKey'),
            'konteks_riwayat' => 'Akun Karyawan',
            'deskripsi_riwayat' => 'menghapus karyawan '.$request->nama_lengkap_karyawan.'',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Karyawan berhasil dihapus');
    }
}
