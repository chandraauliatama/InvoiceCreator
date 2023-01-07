<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Invoice $invoice)
    {
        $date = $invoice->invoice_date->format('jFY');
        $name = str_replace(' ', '', Str($invoice->worker_name)->headline());
        $file_name = 'invoice_'.$date.'_'.$name.'.pdf';
        $total = 0;

        $pdf = Pdf::loadView('print', compact('invoice', 'file_name', 'space', 'total'));

        return $pdf->stream($file_name);
    }
}
