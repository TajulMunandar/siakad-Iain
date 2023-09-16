<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\BeritaAcaraDetail;
use Illuminate\Http\Request;

class RekapBeritaAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      if(auth()->user()->isAdmin){
        $beritas = BeritaAcara::withCount('beritaAcaraDetail')->get();
      }
      else{
        $beritas = BeritaAcara::where('id_dosen', auth()->user()->dosen->first()->id)->withCount('beritaAcaraDetail')->get();
      }
      return view('rekap-ba.index')->with(compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
