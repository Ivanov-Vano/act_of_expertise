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

        $replacements = $products->toArray();

        $templateProcessor->cloneBlock('block_product', 0, true, false, $replacements);
        /*        foreach ($products as $product)
        {
            $templateProcessor->setValue('product_name', $product->name);
            $templateProcessor->setValue('product_number', $product->number);
            $templateProcessor->setValue('product_code', $product->hscode->code);
        }*/

        $templateProcessor->setValue('measure', $act->measure);
        $templateProcessor->setValue('gross', $act->gross);
        $templateProcessor->setValue('netto', $act->netto);

        $templateProcessor->setValue('position', $act->position);
        $templateProcessor->setValue('contract', $act->contract);
        $templateProcessor->setValue('invoice', $act->invoice);

        $templateProcessor->setValue('exporter_name', $act->exporter->short_name);
        $templateProcessor->setValue('exporter_inn', $act->exporter->inn);
        $templateProcessor->setValue('exporter_address', $act->exporter->address);
        $templateProcessor->setValue('exporter_country', $act->exporter->country->short_name);

        $templateProcessor->setValue('shipper_name', $act->shipper->short_name);
        $templateProcessor->setValue('shipper_inn', $act->shipper->inn);
        $templateProcessor->setValue('shipper_address', $act->shipper->address);
        $templateProcessor->setValue('shipper_country', $act->shipper->country->short_name);

        $templateProcessor->setValue('manufacturer_name', $act->manufacturer->short_name);
        $templateProcessor->setValue('manufacturer_inn', $act->manufacturer->inn);
        $templateProcessor->setValue('manufacturer_address', $act->manufacturer->address);
        $templateProcessor->setValue('manufacturer_country', $act->manufacturer->country->short_name);

        $templateProcessor->setValue('importer_name', $act->importer->short_name);
        $templateProcessor->setValue('importer_inn', $act->importer->inn);
        $templateProcessor->setValue('importer_address', $act->importer->address);
        $templateProcessor->setValue('importer_country', $act->importer->country->short_name);

        $templateProcessor->setValue('consignee_name', $act->consignee->short_name);
        $templateProcessor->setValue('consignee_inn', $act->consignee->inn);
        $templateProcessor->setValue('consignee_address', $act->consignee->address);
        $templateProcessor->setValue('consignee_country', $act->consignee->country->short_name);

        $templateProcessor->setValue('cargo', $act->cargo);
        $templateProcessor->setValue('package', $act->package);

        isset($act->expert->sign_path) ?
            $templateProcessor->setImageValue('sign', 'storage/'.$act->expert->sign_path) : '';
        $fileName = $myDateTime->format('dmY').'_'.$act->id;
        $templateProcessor->saveAs($fileName.'.docx');

        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }
}
