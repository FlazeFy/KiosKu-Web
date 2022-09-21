<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    
        //Set active nav
        session()->put('active_nav', 'pengingat');

        return view ('admin.pengingat.index')
            ->with('day_around', $this->get_days_around())
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
