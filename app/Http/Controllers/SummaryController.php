<?php

namespace App\Http\Controllers;

use App\Summary;
use PDF;

class SummaryController extends Controller
{
    public function index()
    {
        $data = Summary::pdf();
        $pdf = PDF::loadView(
            'pdf.summary',
            $data
        )->setPaper('a4', 'landscape');

        return $pdf->stream('summary.pdf');
    }
}
