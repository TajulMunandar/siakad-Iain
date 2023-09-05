<?php

namespace App\Http\Controllers;

use App\Models\Survei;
use App\Http\Requests\StoreSurveiRequest;
use App\Http\Requests\UpdateSurveiRequest;

class SurveiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $surveis = Survei::all();
        return view('survei.data_survei.index')->with(compact('surveis'));
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
    public function store(StoreSurveiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Survei $survei)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survei $survei)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSurveiRequest $request, Survei $survei)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survei $survei)
    {
        //
    }
}
