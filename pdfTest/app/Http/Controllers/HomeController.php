<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class HomeController extends Controller
{
    public function generatePDF()

    {

        $data = ['title' => 'Welcome to HDTuto.com'];

        $pdf = PDF::loadView('myPDF', $data);



        return $pdf->download('hdtuto.pdf');

    }
}
