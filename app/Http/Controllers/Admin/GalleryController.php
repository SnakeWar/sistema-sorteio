<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryPhotoDeleteRequest;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\GalleryUpdateRequest;
use App\Http\Requests\SlideRequest;
use App\Http\Requests\SlideUpdateRequest;
use App\Models\Gallery;
use App\Models\GalleryPhotos;
use App\Models\Slide;
use App\Traits\UploadTraits;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    use UploadTraits;

    private $model;

    public function __construct(Gallery $model)
    {
        $this->model = $model;
        $this->title = 'Galeria';
        $this->subtitle = 'Galeria';
        $this->middleware('auth');
        $this->admin = 'admin.galleries';
        $this->view = 'galleries';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->admin . '.index', [
            'model' => $this->model->with(['photos', 'user'])->orderBy('id', 'desc')->paginate(10),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'admin' => $this->admin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view($this->admin . '.form', ['title' => $this->title, 'subtitle'=> $this->subtitle, 'admin' => $this->admin]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($data['title']);
        if($request->hasFile('photo')){
            $data['photo'] = $this->imageUpload($request->file('photo'), $this->view);
        }

        $model = $this->model->create($data);

        if($request->hasFile('photos')){
            $images = $this->imagesUpload($request->file('photos'), $this->view, 'photo');
            $model->photos()->createMany($images);
        }

        flash($this->subtitle . ' Criado com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->with('photos')->findOrFail($id);
        //dd($model);
        return view($this->admin . '.form',
            ['model' => $model,
                'title' => $this->subtitle,
                'subtitle' => $this->subtitle,
                'admin' => $this->admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request, $id)
    {
        $data = $request->except(['photos']);

        $model = $this->model->find($id);

        if($request->hasFile('photo')){
            if(Storage::disk('public')->exists($model->photo)){
                Storage::disk('public')->delete($model->photo);
            }
            $data['photo'] = $this->imageUpload($request->file('photo'), $this->view);
        }

        $model->update($data);

        if($request->hasFile('photos')){
            $images = $this->imagesUpload($request->file('photos'), $this->view, 'photo');
            $model->photos()->createMany($images);
            flash('Foto(s) adicionadas com Sucesso!')->success();
            return redirect()->back();
        }

        flash($this->subtitle . ' Atualizado com Sucesso!')->success();
        return redirect()->route($this->admin.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        flash($this->subtitle . ' Removido com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
    }
    public function removePhoto(GalleryPhotoDeleteRequest $request){

        $photoName = $request->get('photoName');

        //removo dos arquivos
        if(Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }
        //removo a imagem do banco
        $removePhoto = GalleryPhotos::where('photo', $photoName)->first();
        $Galleryid = $removePhoto->gallery_id;
        $removePhoto->delete();

        return redirect()->back();

    }
    public function ativo($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->status == 0){
            $model->status = 1;
            $model->update();
            flash('Ativado!')->success();
            return redirect()->back();
        }
        else{
            $model->status = 0;
            $model->update();
            flash('Desativado!')->warning();
            return redirect()->back();
        }
    }
    public function destaque($id)
    {
        $post = $this->model->findOrFail($id);
        if($post->highlight == false){
            $post->highlight = true;
            $post->update();
            flash('Esse post agora é destaque!')->success();
            return redirect()->back();
        }
        else{
            $post->highlight = false;
            $post->update();
            flash('Esse post deixou de ser destaque!')->warning();
            return redirect()->back();
        }
    }
}
