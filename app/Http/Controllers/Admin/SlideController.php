<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Http\Requests\SlideUpdateRequest;
use App\Models\Slide;
use App\Traits\UploadTraits;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    use UploadTraits;

    private $slide;

    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
        $this->title = 'Slides';
        $this->subtitle = 'Slide';
        $this->middleware('auth');
        $this->admin = 'admin.slides';
        $this->view = 'slides';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->admin . '.index', [
            'slides' => $this->slide->with('photos')->paginate(10),
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
        return view($this->admin . '.create', ['title' => $this->title, 'subtitle'=> $this->subtitle]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('photo')){
            $data['photo'] = $this->imageUpload($request->file('photo'));
        }

        $slide = $this->slide->create($data);

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
        $slide = $this->slide->with('photos')->findOrFail($id);
        //dd($slide);
        return view($this->admin . '.edit', ['slide' => $slide, 'title' => $this->subtitle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideUpdateRequest $request, $id)
    {
        $data = $request->except(['photos']);

        $slide = $this->slide->find($id);

        if($request->hasFile('photo')){
            if(Storage::disk('public')->exists($slide->photo)){
                Storage::disk('public')->delete($slide->photo);
            }
            $data['photo'] = $this->imageUpload($request->file('photo'), $this->view);
        }

        $slide->update($data);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), $this->view);
            $slide->photos()->createMany($images);
            flash('Foto(s) adicionadas com Sucesso!')->success();
            return redirect()->back();
        }

        flash($this->subtitle . ' Atualizado com Sucesso!')->success();
        return redirect()->route('admin.slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = $this->slide->find($id);
        $slide->delete();

        flash($this->subtitle . ' Removido com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
    }
}
