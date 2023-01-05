<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
        $pdf = Pdf::loadView('welcome', compact('invoice'));

        $date = Carbon::create($invoice->invoice_date);
        $date = $date->format('jFY');
        $name = str_replace(" ", "",$invoice->worker_name);

        $file_name = "invoice_" . $date . "_" . $name . ".pdf";

        return $pdf->stream($file_name);
    }
}
