<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use App\Models\Post;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    use UploadTraits;

    private $contact;

    public function __construct(Contact $model, Category $category)
    {
        $this->model = $model;
        $this->category = $category;
        $this->title = 'Contatos';
        $this->subtitle = 'Contato';
        $this->middleware('auth');
        $this->admin = 'admin.contacts';
        $this->view = 'contacts';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->admin . '.index', [
            'model' => $this->model->get(),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model->findOrFail($id);
        $model->readed = 1;
        $model->save();
        return view($this->admin.'.form', [
            'model' => $model,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'admin' => $this->admin,
            'view' => $this->view
        ]);
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

        flash($this->subtitle . ' Removido com Sucesso!')->success();
        return redirect()->route($this->admin . '.index');
    }
}
