<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function downloadDocx(Request $request)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord;
        // Adding an empty Section to the document...
        $section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
        $section->addText($request->get('name'),
            array('name' => 'Times New Roman', 'size' => 14));

// Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($request->get('name').'.docx');

        return response()->download(public_path($request->get('name').'.docx'));
    }
}
