<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ManasysController extends Controller
{
    //
    public function showMil() {
        return view('mil');
    }

    public function showMnr() {
        return view('mnr');
    }

    public function showMid() {
        return view('mid');
    }

    public function showMie() {
        return view('mie');
    }




}
