<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LawyerRequest;
use App\Http\Requests\LawyerUpdateRequest;
use App\Http\Requests\PageRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Lawyer;
use App\Models\Page;
use App\Models\User;
use App\Models\Post;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LawyerController extends Controller
{
    use UploadTraits;

    private $model;

    public function __construct(Lawyer $model, Category $category)
    {
        $this->model = $model;
        $this->title = 'Advogados';
        $this->subtitle = 'Advogado';
        $this->middleware('auth');
        $this->admin = 'admin.lawyers';
        $this->view = 'lawyers';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->admin . '.index', [
            'model' => $this->model->with('user')->orderBy('id', 'desc')->paginate(1000),
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
        return view($this->admin . '.form', [
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
    public function store(LawyerRequest $request)
    {
        $data = $request->all();
        //$categories = $request->get('categories', null);
        $data['user_id'] = Auth::user()->id;
        //dd($data);

        $model = $this->model->create($data);

        flash($this->subtitle . ' Criada com Sucesso!')->success();
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
        $model = $this->model->findOrFail($id);
        return view($this->admin . '.form', [
            'model' => $model,
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
    public function update(LawyerUpdateRequest $request, $id)
    {
        $data = $request->except(['categories', 'photos']);

        $model = $this->model->findOrFail($id);

        $model->update($data);



        flash($this->subtitle . ' Atualizada com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
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

        flash($this->subtitle . ' Removida com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
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
}
