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
        $products = $act->products;
        $myFio = $act->expert->getFio();
        $myDateTime = date_create_from_format('Y-m-d', $act->date);
        $templateProcessor = new TemplateProcessor('word-template/act_template.docx');
        $templateProcessor->setValue('type', $act->type->short_name);

        $templateProcessor->setValue('number', $act->number);
        $templateProcessor->setValue('expert', $myFio);
        $templateProcessor->setValue('date', $myDateTime->format('d.m.Y'));
        $templateProcessor->setValue('reason', $act->reason);

        $templateProcessor->setValue('customer_name', $act->customer->short_name);
        $templateProcessor->setValue('customer_inn', $act->customer->inn);
        $templateProcessor->setValue('customer_adress', $act->customer->address);

        foreach ($products as $product)
        {
            $templateProcessor->setValue('product_name', $product->name);
            $templateProcessor->setValue('product_number', $product->number);
            $templateProcessor->setValue('product_code', $product->hscode->code);
        }

        $templateProcessor->setImageValue('sign', 'storage/'.$act->expert->sign_path);
        $fileName = $myDateTime->format('dmY').'_'.$act->id;
        $templateProcessor->saveAs($fileName.'.docx');

        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }
}
