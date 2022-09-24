<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ArsipController extends Controller
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
            
        $archieve = DB::table('arsip')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();   
    
        //Set active nav
        session()->put('active_nav', 'arsip');

        return view ('admin.arsip.index')
            ->with('rak', $rak)
            ->with('archieve', $archieve);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, $id)
    {
        $arsip = [];
       
        $arsip[] = [
            'id' => $id,
            'nama_arsip' => $request->nama_arsip
        ];
            
        $request->session()->put('view_archieve', );

        return redirect()->back();
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
}
