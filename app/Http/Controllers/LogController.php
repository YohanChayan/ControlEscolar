<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::where('type', 'admin')->orderBy('created_at','desc')->paginate(15);

        $html_table = view('admin.logs.index_logTable')->with('records', $logs);

        return view('admin.logs.index')->with('dataTable_admins', $html_table);
    }

    public function indexStudents()
    {
        $logs = Log::where('type', 'student')->orderBy('created_at','desc')->paginate(15);

        $html_table = view('admin.logs.index_logTable')->with('records', $logs);

        return view('admin.logs.index')->with('dataTable_students', $html_table);
    }
}
