<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;
    protected $title;
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->title = 'Grupos';
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = $this->role->orderBy('id', 'desc')->with(['permissions'])->paginate(10);
        return view('admin.roles.index', ['roles' => $roles, 'title' => 'Grupos', 'subtitle' => 'Adicionar Grupo']);
    }
    public function create()
    {
        $permissions = $this->role->permissions;
        $formatedPermissions = array();
        foreach ($permissions as $permission) {
            $formatedPermissions[$permission->id] = $permission->title;
        }

        $modules = Module::orderBy('id', 'desc')->with(['permissions'])->get();
        return view('admin.roles.form', ['permissions' => $formatedPermissions, 'modules' => $modules,'title' => $this->title, 'subtitle' => 'Adicionar grupo']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        $dataForm = $request->all();
        unset($dataForm['permissions']);
        $role = $this->role->create($dataForm);
        $dataForm = $request->all();
        if (isset($dataForm['permissions']) && !is_null($dataForm['permissions'])) {
            $permissions = Permission::find($dataForm['permissions']);
            $role->permissions()->attach($permissions);
        }
        if($role){
            flash('Grupo Criado com Sucesso!')->success();
            return redirect('/admin/roles');
        }else {
            flash('Erro ao Criar Grupo!')->success();
            return redirect('/admin/roles');
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
        $role = $this->role->find($id);
        $permissions = $role->permissions;
        $formatedPermissions = array();
        foreach ($permissions as $permission) {
            $formatedPermissions[$permission->id] = $permission->title;
        }
        $modules = Module::orderBy('id', 'desc')->with(['permissions'])->get();
        $data = ['role' => $role, 'permissions' => $formatedPermissions, 'modules' => $modules, 'title' => $this->title, 'subtitle' => 'Editar Grupo'];
        return view('admin.roles.form')->with($data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $role = $this->role->find($id);
        $role->permissions()->detach();
        if (isset($dataForm['permissions']) && !is_null($dataForm['permissions'])) {
            $permissions = Permission::find($dataForm['permissions']);
            $role->permissions()->attach($permissions);
        }
        unset($dataForm['permissions']);
        if($role->update($dataForm)){
            return redirect('/admin/roles')->with('success', 'Grupo alterado com sucesso!');
        }else{
            return redirect('/admin/roles')->with('fail', 'Falha ao editar o grupo!');
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
        $role = $this->role->find($id);
        $this->role->destroy($id);
        $role->permissions()->detach();
        if($role){
            return redirect('/admin/roles')->with('success', 'Grupo excluído com sucesso!');
        }else {
            return redirect('/admin/roles')->with('fail', 'Falha ao excluir o grupo!');
        }
    }
}
