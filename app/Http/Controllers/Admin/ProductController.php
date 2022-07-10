<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Post;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use UploadTraits;

    private $product;

    public function __construct(Product $model, Category $category)
    {
        $this->model = $model;
        $this->category = $category;
        $this->title = 'Produtos';
        $this->subtitle = 'Produto';
        $this->middleware('auth');
        $this->admin = 'admin.products';
        $this->view = 'products';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->admin . '.index', [
            'model' => $this->model->with('user')->paginate(100),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        return view($this->admin . '.form', [
            'categories' => $categories,
            'title' => $this->title,
            'subtitle'=> $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        //$categories = $request->get('categories', null);
        $data['user_id'] = Auth::user()->id;
//        dd($data);
        if($request->hasFile('photo')){
            $data['photo'] = $this->imageUpload($request->file('photo'), $this->view);
        }

        $model = $this->model->create($data);

        //$model->categories()->sync($categories);
        if($model){
            flash($this->subtitle . ' Criada com Sucesso!')->success();
            return redirect()->route($this->admin . '.index');
        }
        else{
            flash($this->subtitle . ' Ocorreu uma erro ao salvar!')->error();
            return redirect()->back();
        }

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
        $categories = Category::all();
        //dd($categories[0]->title);
        $model = $this->model->findOrFail($id);
        //dd($model);
        return view($this->admin . '.form', [
            'model' => $model,
            'categories' => $categories,
            'title' => $this->title,
            'subtitle'=> $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $data = $request->except(['photos']);

        //$categories = $request->get('categories', null);
        //dd($data, $id);
        $model = $this->model->findOrFail($id);

        if($request->hasFile('photo')){
            if(Storage::disk('public')->exists($model->photo)){
                Storage::disk('public')->delete($model->photo);
            }
            $data['photo'] = $this->imageUpload($request->file('photo'), $this->view);
        }

        $ok = $model->update($data);

        //if(!is_null($categories)) $model->categories()->sync($categories);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'photo');
            $model->photos()->createMany($images);
            flash('Foto(s) adicionadas com Sucesso!')->success();
            return redirect()->back();
        }
        if($ok){
            flash($this->subtitle . ' Atualizada com Sucesso!')->success();
            return redirect()->route($this->admin . '.index');
        }
        else{
            flash($this->subtitle . ' Atualizada com Sucesso!')->error();
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();

        flash($this->subtitle . 'Removido com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
    }
    public function ativo($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->status == false){
            $model->status = true;
            $model->update();
            flash('Ativado!')->success();
            return redirect()->back();
        }
        else{
            $model->status = false;
            $model->update();
            flash('Desativado!')->warning();
            return redirect()->back();
        }
    }
}
