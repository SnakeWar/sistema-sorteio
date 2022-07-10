<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlidePhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidePhotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function removePhoto(Request $request){

        $photoName = $request->get('photoName');

        //removo dos arquivos
        if(Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }
        //removo a imagem do banco
        $removePhoto = SlidePhotos::where('photo', $photoName);
        $Slideid = $removePhoto->first()->slide_id;
        $removePhoto->delete();

        return redirect()->route('admin.slides.edit', ['slide' => $Slideid])->withSuccess('Removido com sucesso!');

    }
}
