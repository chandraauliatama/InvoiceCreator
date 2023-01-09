<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function __invoke(Invoice $invoice)
    {
        $invoiceDate = $invoice->invoice_date->format('jFY');
        $workerName = str($invoice->worker_name)->replace(' ', '')->headline();
        $fileName = "invoice_{$invoiceDate}_{$workerName}.pdf";
        $total = 0;

        $pdf = PDF::loadView('print', compact('invoice', 'fileName', 'total'));

        return $pdf->stream($fileName);
    }
}
