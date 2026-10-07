<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    private LogAktivitasService $logAktivitasService;

    public function __construct(\App\Services\LogAktivitasService $logAktivitasService)
    {
        $this->logAktivitasService = $logAktivitasService;
    }

    public function index(Request $request)
    {
        $logs = $this->logAktivitasService->getAll($request->get('search'));
        return response()->json($logs);
    }
}
