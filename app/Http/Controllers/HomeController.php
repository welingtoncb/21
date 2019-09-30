<?php

namespace App\Http\Controllers;

use App\Http\Services\ImovelService;

class HomeController extends Controller
{
    /**
     *
     * @var $imovelService
     */
    private $imovelService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ImovelService $imovelService)
    {
        $this->middleware('auth');
        $this->imovelService = $imovelService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalImoveisCadastrados = $this->imovelService->totalImmobile();

        return view('home', compact('totalImoveisCadastrados'));
    }
}
