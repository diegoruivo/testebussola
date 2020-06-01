<?php

namespace TesteBussola\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TesteBussola\Http\Controllers\Controller;
use TesteBussola\Serie;
use TesteBussola\System;
use TesteBussola\Http\Requests\Admin\Serie as SerieRequest;


class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Serie::all();
        $system = System::where('id', 1)->first();

        return view('admin.series.index', [
            'series' => $series,
            'system' => $system
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $system = System::where('id', 1)->first();

        return view('admin.series.create', [
            'system' => $system
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SerieRequest $request)
    {
        $createSerie = Serie::create($request->all());

        return redirect()->route('admin.series.edit', [
            'serie' => $createSerie->id
        ])->with(['color' => 'green', 'message' => 'Série cadastrada com sucesso!']);
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
        $serie = Serie::where('id', $id)->first();
        $system = System::where('id', 1)->first();

        return view('admin.series.edit', [
            'serie' => $serie,
            'system' => $system
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SerieRequest $request, $id)
    {
        $updateSerie = Serie::where('id', $id)->first();
        $updateSerie->fill($request->all());
        $updateSerie->save();

        return redirect()->route('admin.series.edit', [
            'course' => $updateSerie->id
        ])->with(['color' => 'green', 'message' => 'Série atualizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
         $destroySerie = Serie::destroy($serie->id);

        return redirect()->route('admin.series.index', [
            'serie' => $serie->id
        ])->with(['color' => 'green', 'message' => 'Série excluída com sucesso!']);
    }
}
