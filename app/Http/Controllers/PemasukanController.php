<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\User;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan = pemasukan::all();    
        return view('pages.pemasukan.index', [
            'pemasukan' => $pemasukan,
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
        return view('pages.pemasukan.create',[
            'user'=> $user,
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
        Pemasukan::create([
            'user_id' => auth()->id(),
            'pemasukan' => $request->pemasukan,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
        ]);
        return redirect()->route('pemasukan.index')->with('sukses','Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pemasukan::find($id);
        return view('pages.pemasukan.show',[
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
        $data = Pemasukan::find($id);
        return view('pages.pemasukan.edit',[
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
        Pemasukan::where('id',$id)->update([
            'user_id' => auth()->id(),
            'pemasukan' => $request->pemasukan,
            'catatan' =>$request->catatan,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
        ]);
        return redirect()->route('pemasukan.index')->with('Success', 'Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pemasukan::find($id);
        $data->delete();
        return redirect()->route('pemasukan.index')->with('Success','Berhasil Dihapus');
    }
}
