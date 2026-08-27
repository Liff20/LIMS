<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\DataProvider;

class AnalitikController extends Controller
{
    public function index(Request $request)
    {
        $data = DataProvider::analitik();

        $unitFilter = $request->query('unit');
        $jenisFilter = $request->query('jenis');

        return view('analitik.index', [
            'data' => $data,
            'units' => DataProvider::units(),
            'jenis' => DataProvider::jenisBarang(),
            'filters' => ['unit' => $unitFilter, 'jenis' => $jenisFilter],
        ]);
    }
}
