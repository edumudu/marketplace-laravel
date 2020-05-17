<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $store;

    public function __construct(Store $store)
    {
      $this->store = $store;
    }

    public function show($slug)
    {
      $store = $this->store->whereSlug($slug)->first();

      return view('store', compact('store'));
    }
}
