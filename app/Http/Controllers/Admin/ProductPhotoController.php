<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $photoName
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $photoName = $request->get('photoName');

        if(Storage::disk('public')->exists($photoName)) {
          Storage::disk('public')->delete($photoName);
        }

        $photo = ProductPhoto::where('image', $photoName);
        $productId = $photo->first()->product_id;
        $photo->delete();

        flash('Imagem removida com sucesso!')->success();

        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}
