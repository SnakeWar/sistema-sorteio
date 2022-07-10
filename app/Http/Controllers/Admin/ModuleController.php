<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleFormRequest;
use App\Models\Module;
use App\Models\Permission;
use App\Traits\Functions;
use Illuminate\Http\Request;
class ModuleController extends Controller
{
    use Functions;

    protected $module;
    protected $title;
    public function __construct(Module $module, Permission $permission)
    {
        $this->module = $module;
        $this->permission = $permission;
        $this->title = 'Módulos';
        $this->subtitle = 'Módulo';
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = $this->module->orderBy('id', 'desc')->with(['permissions'])->get();
        $data = ['modules' => $modules, 'title' => $this->title, 'subtitle' => $this->subtitle];
        return view('admin.modules.index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = $this->module->orderBy('id', 'desc')->with(['permissions'])->paginate(10);
        $data = ['modules' => $modules, 'title' => $this->title, 'subtitle' => 'Adicionar módulo'];
        return view('admin.modules.form')->with($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleFormRequest $request)
    {
        $dataForm = $request->all();
        $module = $this->module->create($dataForm);
        if (isset($module) && !is_null($module)) {
            // CRUD permissions
            $this->permission->create(array('title' => ('create_'.strtolower($this->sanitizeString  ($module->url))), 'module_id' => $module->id));
            $this->permission->create(array('title' => ('read_'.strtolower($this->sanitizeString($module->url))), 'module_id' => $module->id));
            $this->permission->create(array('title' => ('update_'.strtolower($this->sanitizeString($module->url))), 'module_id' => $module->id));
            $this->permission->create(array('title' => ('delete_'.strtolower($this->sanitizeString($module->url))), 'module_id' => $module->id));
        }
        if($module){
            return redirect('/admin/modules')->with('success', 'Módulo criado com sucesso!');
        }else {
            return redirect('/admin/modules')->with('fail', 'Falha ao criar o módulo!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = $this->module->find($id);
        $data = ['module' => $module, 'title' => $this->title, 'subtitle' => 'Editar módulo'];
        return view('admin.modules.form')->with($data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $module = $this->module->find($id);
        if($module->update($dataForm)){
            $this->permission->where('module_id', $id)
                ->where('title', 'like', 'create_%')
                ->update(['title' => 'create_'.strtolower($this->sanitizeString($module->url))]);
            $this->permission->where('module_id', $id)
                ->where('title', 'like', 'read_%')
                ->update(['title' => 'read_'.strtolower($this->sanitizeString($module->url))]);
            $this->permission->where('module_id', $id)
                ->where('title', 'like', 'update_%')
                ->update(['title' => 'update_'.strtolower($this->sanitizeString($module->url))]);
            $this->permission->where('module_id', $id)
                ->where('title', 'like', 'delete_%')
                ->update(['title' => 'delete_'.strtolower($this->sanitizeString($module->url))]);
            flash($this->subtitle . ' Atualizada com Sucesso!')->success();
            return redirect('/admin/modules');
        }else{
            flash('Houve problema ao atualizar' . $this->subtitle . '!')->error();
            return redirect('/admin/modules');
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
        $module = $this->module->find($id);
        $this->module->destroy($id);
        // Deletes module\s permission
        $module->permissions()->update(['deleted_at' => now()]);
        if($module){
            flash($this->subtitle . ' Excluído(a) com Sucesso!')->success();
            return redirect('/admin/modules');
        }else {
            flash('Houve problema ao excluir' . $this->subtitle . '!')->error();
            return redirect('/admin/modules');
        }
    }
}
