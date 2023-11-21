<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggaran = Anggaran::all();    
        return view('pages.anggaran.index', [
            'anggaran' => $anggaran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Katergori::all();
        $pemasukan = Pemasukan ::all();
        return view('pages.anggaran.create',[
            'kategori'=> $kategori,
            'pemasukan' => $pemasukan,            

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Anggaran::create([
            'pemasukan_id'=> $request->id_pemasukan,
            'kategori_id'=> $request->id_kategori,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('anggaran.index')->with('sukses','Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Anggaran::find($id);
        return view('pages.anggaran.show',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Anggaran::find($id);
        return view('pages.anggaran.edit',[
            'data' => $data
        ]);
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
        Anggaran::where('id',$id)->update([
            'pemasukan_id' ->$request->pemasukan_id,
            'kategori_id' -> $request->kategori_id,
            'tanggal' -> $request->tanggal,
        ]);
        return redirect()->route('anggaran.index')->with('Success', 'Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Anggaran::find($id);
        $data->delete();
        return redirect()->route('anggaran.index')->with('Success','Berhasil Dihapus');
    }
}
