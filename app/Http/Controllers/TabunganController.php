<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabungan = Tabungan::all();    
        return view('pages.tabungan.index', [
            'tabungan' => $tabungan,
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
        return view('pages.tabungan.create',[
            'user' => $user,
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
        Tabungan::create([
            'user_id' => auth()->id(),
            'nama'=> $request->nama,
            'anggaran'=> $request->anggaran,
            'periodelMulai' => $request->periodelMulai,
            'periodeSelesai' => $request->periodeSelesai,
        ]);
        return redirect()->route('tabungan.index')->with('sukses','Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tabungan::find($id);
        return view('pages.tabungan.show',[
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
        $data = Tabungan::find($id);
        return view('pages.tabungan.edit',[
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
        Tabungan::where('id',$id)->update([
            'user_id' => auth()->id(),
            'nama'=> $request->nama,
            'anggaran'=> $request->anggaran,
            'periodelMulai' => $request->periodelMulai,
            'periodeSelesai' => $request->periodeSelesai,
        ]);
        return redirect()->route('tabungan.index')->with('Success', 'Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tabungan::find($id);
        $data->delete();
        return redirect()->route('tabungan.index')->with('Success','Berhasil Dihapus');
    }
}
