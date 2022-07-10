<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostPhotosController extends Controller
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
        $removePhoto = PostPhotos::where('photo', $photoName);
        $Postid = $removePhoto->first()->post_id;
        $removePhoto->delete();

        return redirect()->route('admin.posts.edit', ['post' => $Postid])->withSuccess('Removido com sucesso!');

    }
}
