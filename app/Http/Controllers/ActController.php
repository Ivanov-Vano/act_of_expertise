<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreActRequest;
use App\Http\Requests\UpdateActRequest;
use App\Models\Act;
use PhpOffice\PhpWord\TemplateProcessor;


class ActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acts = Act::all();
        return view('index',compact('acts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $act = Act::findOrFail($id);
        return view('show', compact('act'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Http\Response
     */
    public function edit(Act $act)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActRequest  $request
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActRequest $request, Act $act)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Http\Response
     */
    public function destroy(Act $act)
    {
        //
    }

    /**
     * Печать текущего акта в Word.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function wordExport($id)
    {
        $act = Act::findOrFail($id);
        $myFio = $act->expert->surname.' '.mb_substr($act->expert->name, 0, 1).'. '.mb_substr($act->expert->patronymic, 0, 1).'.';
        $myDateTime = date_create_from_format('Y-m-d', $act->date);
        $templateProcessor = new TemplateProcessor('word-template/act_template.docx');
        $templateProcessor->setValue('number', $act->number);
        $templateProcessor->setValue('expert', $myFio);
        $templateProcessor->setValue('date', $myDateTime->format('d.m.Y'));
        $fileName = $act->id;
        $templateProcessor->saveAs($fileName.'.docx');

        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }
}
