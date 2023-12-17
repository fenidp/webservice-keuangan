<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::all();    
        return view('pages.pengeluaran.index', [
            'pengeluaran' => $pengeluaran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all(); 
        $kategori = Kategori::get();
        $pemasukan = Pemasukan ::get();
        return view('pages.pengeluaran.create',[
            'user' => $user,
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
        Pengeluaran::create([
            'user_id' => auth()->id(),
            'kategori_id'=> $request->kategori_id,
            'pemasukan_id'=> $request->pemasukan_id,
            'pengeluaran' => $request->pengeluaran,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
        ]);
        return redirect()->route('pengeluaran.index')->with('sukses','Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pengeluaran::find($id);
        return view('pages.pengeluaran.show',[
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
        $pemasukan = Pemasukan::get();
        $kategori = Kategori::get(); 
        $data = Pengeluaran::find($id);
        return view('pages.pengeluaran.edit',[
            'pemasukan' => $pemasukan,
            'kategori' => $kategori,
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
        Pengeluaran::where('id',$id)->update([
            'user_id' => auth()->id(),
            'kategori_id' => $request->kategori_id,
            'pemasukan_id' =>$request->pemasukan_id,
            'pengeluaran' => $request->pengeluaran,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
            'jam'=>$request->jam
        ]);
        return redirect()->route('pengeluaran.index')->with('Success', 'Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengeluaran::find($id);
        $data->delete();
        return redirect()->route('pengeluaran.index')->with('Success','Berhasil Dihapus');
    }
}
