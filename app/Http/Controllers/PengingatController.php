<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Kegiatan;
use App\Models\Tandai;

class PengingatController extends Controller
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
        
        //Kegiatan hari ini
        if(session()->get('filter_day_key') == null){
            $date = date("Y-m-d");
        } else {
            $date = date("Y-m-d", strtotime(session()->get('filter_day_key')));
        }

        // $kegiatan = DB::table('kegiatan')
        //     ->where('id_kios', session()->get('idKey'))
        //     ->whereRaw("DATE(waktu_mulai) = '".$date."'")
        //     ->orderBy('waktu_mulai', 'ASC')->get();   

        //Check this again!!!
        $kegiatan = Kegiatan::leftJoin("tandai", function ($join) {
            $join->on("kegiatan.id", "=", "tandai.id_context")
            ->where('tandai.type_context', 'kegiatan');
            })
            ->select('kegiatan.id', 'kegiatan_title', 'kegiatan_desc', 'kegiatan_type', 'kegiatan_url', 'waktu_mulai', 'waktu_selesai', 'kegiatan.created_at', 'kegiatan.updated_at', 'tandai.id_tandai', 'tandai.id_context', 'tandai.type_context')            ->where('kegiatan.id_kios', session()->get('idKey'))
            ->groupBy('kegiatan.id')
            ->where('kegiatan.id_kios', session()->get('idKey'))
            ->whereRaw("DATE(waktu_mulai) = '".$date."'")
            ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai')
            ->orderBy('waktu_mulai', 'ASC')
            ->get();
    
        //Set active nav
        session()->put('active_nav', 'pengingat');

        return view ('admin.pengingat.index')
            ->with('day_around', $this->get_days_around())
            ->with('kegiatan', $kegiatan)
            ->with('rak', $rak);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_days_around()
    {
        $val = session()->get('filter_day_key');

        $day = [];
        
        for($i = -1; $i < 7; $i++){
            $day[] = date('Y-M-d', strtotime($val." +".$i." day"));
            
        }

        return $day;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set_day_filter(Request $request)
    {
        $request->session()->put('filter_day_key', $request->date);

        return redirect()->back()->with('success_message', 'Tanggal berhasil diubah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambah_kegiatan(Request $request)
    {
        if($request->has('kegiatan_url')){
            //Validate image.
            $this->validate($request, [
                'kegiatan_url'     => 'required|image|mimes:jpeg,png,jpg|max:5000',
            ]);

            //Upload image.
            $image = $request->file('kegiatan_url');
            $image->storeAs('public', $image->hashName());
            $imageURL = $image->hashName();

            //Convert to json.
            $object = array([
                "type"=>"image",
                "url"=>$imageURL
            ]);
            $imageURL = json_encode($object);
        } else {
            $imageURL = null;
        }

        Kegiatan::create([
            'id_kios' => session()->get('idKey'),
            'assignee' => null,
            'kegiatan_title' => $request->kegiatan_title,
            'kegiatan_desc' => $request->kegiatan_desc,
            'kegiatan_type' => $request->kegiatan_type,
            'kegiatan_url' => $imageURL,
            'waktu_mulai' => date("Y-m-d H:i", strtotime($request->kegiatan_date_mulai."".$request->kegiatan_hour_mulai)),
            'waktu_selesai' => date("Y-m-d H:i", strtotime($request->kegiatan_date_selesai."".$request->kegiatan_hour_selesai)),
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Pengingat berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_kegiatan(Request $request, $id)
    {
        Kegiatan::where('id', $id)->update([
            'kegiatan_title' => $request->kegiatan_title,
            'kegiatan_desc' => $request->kegiatan_desc,
            'kegiatan_type' => $request->kegiatan_type,
            'waktu_mulai' => date("Y-m-d H:i", strtotime($request->kegiatan_date_mulai."".$request->kegiatan_hour_mulai)),
            'waktu_selesai' => date("Y-m-d H:i", strtotime($request->kegiatan_date_selesai."".$request->kegiatan_hour_selesai)),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Pengingat berhasil diedit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view_pengingat(Request $request)
    {
        if($request->toggle_view ==  true){
            $request->session()->put('view_pengingat', 'Detail');
        } else {
            $request->session()->put('view_pengingat', '');
        }

        return redirect()->back()->with('success_message', 'Tampilan Pengingat berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus_hour_kegiatan($id)
    {
        $result = DB::table('kegiatan')
            ->whereRaw("DATE(waktu_mulai) = '". date("Y-m-d", strtotime(session()->get('filter_day_key')))."'")
            ->whereRaw("time(waktu_mulai) LIKE '".sprintf('%02d', $id)."%'")
            ->delete();

        return redirect()->back()->with('success_message', $result.' Pengingat berhasil dihapus');
    }

    public function hapus_kegiatan($id)
    {
        Kegiatan::destroy($id);

        return redirect()->back()->with('success_message', 'Pengingat berhasil dihapus');
    }

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
            'type_context' => 'kegiatan',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Kegiatan ditandai');
    }
}
