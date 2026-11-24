<?php

namespace App\Http\Controllers;

class CodSettlementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("cod_settlements.index");
    }

}
