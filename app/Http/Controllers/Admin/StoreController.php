<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Store;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
      $this->middleware('user.has.store')->only('store', 'create');
    }

    public function index()
    {
      $store = auth()->user()->store;

      return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
      return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
    {
      $data = $request->all();
      $user = auth()->user();

      if($request->hasFile('logo')) {
        $data['logo'] = $this->imageUpload($request->file('logo'));
      }

      $user->store()->create($data);

      flash('Loja criada com sucesso')->success();

      return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
      $store = Store::find($store);

      return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
      $data = $request->all();
      $store = Store::find($store);

      if($request->hasFile('logo')) {
        if (Storage::disk('public')->exists($store->logo)) {
          Storage::disk('public')->delete($store->logo);
        }

        $data['logo'] = $this->imageUpload($request->file('logo'));
      }

      $store->update($data);

      flash('Loja atualizada com sucesso')->success();

      return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
      $store = Store::find($store);
      $store->delete();

      flash('Loja removida com sucesso')->success();

      return redirect()->route('admin.stores.index');
    }
}
