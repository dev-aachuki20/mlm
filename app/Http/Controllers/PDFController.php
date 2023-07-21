<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{

    public function index($invoice_id)
    {
        $id = decrypt($invoice_id);
        $data = Invoice::where('id', $id)->first();
        $userenrolled = auth()->user()->packages()->count();
        $pkg_data = json_decode($data->package_json, true);
        $user_data = json_decode($data->user_json, true);
        $logoImage = public_path('images/logo.png');

        $mainArray = [
            'invoice_id' => $data->invoice_number,
            'invoice_date' => $data->date_time,
            'invoice_amount' => $data->amount,
            'logoImage' => $logoImage,
            'userenrolled' => $userenrolled,
            'package_title' => $pkg_data['title'],
            'package_duration' => $pkg_data['duration'],
            'package_level' => $pkg_data['level'],
            'user_name' => $user_data['name'],
            'user_address' => $user_data['address'],
        ];

        $pdf = PDF::loadView('user.pdf.invoice', $mainArray);
        $pdfname = $mainArray['invoice_id'] . '.' . 'pdf';
        return $pdf->download($pdfname);
    }

    public function preview($invoice_id)
    {
        $id = decrypt($invoice_id);
        $data = Invoice::where('id', $id)->first();
        $userenrolled = auth()->user()->packages()->count();
        $pkg_data = json_decode($data->package_json, true);
        $user_data = json_decode($data->user_json, true);
        $logoImage = public_path('images/logo.png');

        $mainArray = [
            'invoice_id' => $data->invoice_number,
            'invoice_date' => $data->date_time,
            'invoice_amount' => $data->amount,
            'logoImage' => $logoImage,
            'userenrolled' => $userenrolled,
            'package_title' => $pkg_data['title'],
            'package_duration' => $pkg_data['duration'],
            'package_level' => $pkg_data['level'],
            'user_name' => $user_data['name'],
            'user_address' => $user_data['address'],
        ];

        $pdf = PDF::loadView('user.pdf.invoice', $mainArray);
        $pdfname = $mainArray['invoice_id'] . '.' . 'pdf';
        return $pdf->stream($pdfname);
    }
}
