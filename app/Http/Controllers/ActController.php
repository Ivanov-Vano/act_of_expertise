<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreActRequest;
use App\Http\Requests\UpdateActRequest;
use App\Models\Act;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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
     * Печать текущего акта в Word.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function wordExport($id)
    {
        $act = Act::findOrFail($id);

        $productsByAct = DB::table('products')
            ->where('act_id', '=', $id)
            ->join('hs_codes', 'hs_codes.id', '=', 'products.hs_code_id')
            ->select('name as product_name', 'brand as product_brand',
                'item_number as product_item_number', 'hs_codes.code as product_hscode')
        ->get();
        $products = $productsByAct->toArray();

        $manufacturersByAct = DB::table('products')
            ->where('act_id', '=', $id)
            ->join('organizations', 'organizations.id', '=', 'products.manufacturer_id')
            ->join('countries', 'countries.id', '=', 'organizations.country_id')
            ->select('organizations.short_name as manufacturer_name', 'organizations.inn as manufacturer_inn',
                'organizations.address as manufacturer_address', 'countries.short_name as manufacturer_country')
            ->groupBy('products.manufacturer_id')
            ->get();
        $manufacturers = $manufacturersByAct->toArray();
        $attachmentsByAct = $act->attachments;
        $attachments = $attachmentsByAct->toArray();
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

        $templateProcessor->cloneBlock('block_product_main', 0, true, false, $products);

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

        $templateProcessor->cloneBlock('block_manufacturer', 0, true, false, $manufacturers);

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

        $templateProcessor->cloneBlock('block_attachment', 0, true, false, $attachments);
        $templateProcessor->cloneBlock('block_product', 0, true, false, $products);

        isset($act->expert->sign_path) ?
            $templateProcessor->setImageValue('sign', 'storage/'.$act->expert->sign_path) : '';
        $fileName = $myDateTime->format('dmY').'_'.$act->id;
        $templateProcessor->saveAs($fileName.'.docx');

        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }
}
