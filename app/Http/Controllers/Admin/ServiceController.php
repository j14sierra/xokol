<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = DB::table('services')->orderBy('sort_order')->get();
        // dd($services); // Debugging line to inspect the retrieved services
        return view('admin.services.index', [
            'services' => $services,
        ]);
    }
}
