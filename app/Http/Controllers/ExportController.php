<?php

namespace App\Http\Controllers;

use App\Exports\StatisticExport;
use App\Http\Services\CountryService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function statistic()
    {
        return Excel::download(new StatisticExport(), 'statistic_' . date('Y-m-d_H:m:s') . '.xlsx');
    }
}
