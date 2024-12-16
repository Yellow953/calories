<?php

namespace App\Http\Controllers;

use App\Exports\LogExport;
use App\Models\Log;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:logs.read')->only('index');
        $this->middleware('permission:logs.export')->only('export');
    }

    public function index()
    {
        $logs = Log::select('text', 'created_at')->filter()->orderBy('created_at', 'desc')->paginate(10);

        return view('app.logs.index', compact('logs'));
    }

    public function export()
    {
        return Excel::download(new LogExport, 'logs.xlsx');
    }
}
