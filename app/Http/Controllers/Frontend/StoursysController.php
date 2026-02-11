<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;          // <-- tambahkan baris ini

class StoursysController extends Controller
{
    public function index()
    {
      return view('frontend.public.stoursys.index');
    }
}