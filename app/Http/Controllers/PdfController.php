<?php


namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class PdfController
{
    public function pdfForm()
    {
        return view('pdf_form');
    }

    public function pdfDownload(Request $request){
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'background' => 'required'
        ]);
        $data =
            [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'backgroundcolor' => $request->background
            ];
        $pdf = PDF::loadView('pdf_download', $data);
        $pdf->setPaper('A4', 'landscape');
       return $pdf->stream("tutsmake.pdf", array("Attachment" => false));

        exit(0);
//        return $pdf->download('tutsmake.pdf');
    }
}
