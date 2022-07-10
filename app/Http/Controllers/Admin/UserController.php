<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserPasswordFormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $title;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->title = 'Usuários';
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->orderBy('id', 'desc')->with(['roles'])->orderBy('id', 'desc')->paginate(10);

        $data = ['users' => $users, 'title' => $this->title, 'subtitle' => 'Adicionar Usuário'];

        return view('admin.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        $data = ['roles' => $roles, 'title' => $this->title, 'subtitle' => 'Adicionar Usuário'];

        return view('admin.users.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['password'] = Hash::make($dataForm['password']);

        $user = $this->user->create($dataForm);

        $role = Role::find($dataForm['role_id']);
        $user->roles()->attach($role);

        if($user && $role){
            return redirect('/admin/users')->with('success', 'Usuário criado com sucesso!');
        }else {
            return redirect('/admin/news')->with('fail', 'Falha ao criar a notícia!');
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
        $user = $this->user->with(['roles'])->find($id);
        $roles = Role::all();
        $data = ['user' => $user, 'roles' => $roles, 'title' => $this->title, 'subtitle' => 'Editar Usuário'];

        return view('admin.users.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $user = $this->user->find($id);

        if($dataForm['password'] == ''){
            unset($dataForm['password']);
        }else{
            $dataForm['password'] = Hash::make($dataForm['password']);
        }

        $role = Role::find($dataForm['role_id']);
        $user->roles()->detach();
        $user->roles()->attach($role);

        if($user->update($dataForm)){
            return redirect('/admin/users')->with('success', 'Usuário editado com sucesso!');
        }else{

            return redirect('/admin/users')->with('fail', 'Falha ao editar usuário!');
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
        $user = $this->user->find($id);
        $this->user->destroy($id);
        $user->roles()->detach();

        return redirect('/admin/users')->with('success', 'Usuário excluído com sucesso!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_user()
    {
        $id = Auth::user()->id;
        $user = $this->user->with(['roles'])->find($id);
        $roles = Role::all();
        $data = ['user' => $user, 'roles' => $roles, 'title' => $this->title, 'subtitle' => 'Editar Usuário'];

        return view('admin.user.form')->with($data);
    }
    public function update_user(UserPasswordFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $user = $this->user->find($id);

        if($dataForm['password'] == ''){
            unset($dataForm['password']);
        }else{
            $dataForm['password'] = Hash::make($dataForm['password']);
        }

        if($user->update($dataForm)){
            flash(' Senha alterada com sucesso!')->success();
            return redirect()->back();
        }else{
            flash(' Houve um erro ao tentar alterar a senha!')->danger();
            return redirect()->back();
        }
    }
}
