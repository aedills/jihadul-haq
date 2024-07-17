<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(Request $request){
        return view('admin/keuangan/index', [
            'title' => 'Data Keuangan | Admin',
            'page' => 'Data Keuangan',
            'path' => 'Data Keuangan',
        ]);
    }
}
