<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    /**
     * @var Game
     */
    private $model;

    public function __construct(Game $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return GameResource::collection($this->model->orderBy('created_at', 'desc')->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['user_id'] = Auth::user()->id;
        $created = $this->model->create($dataForm);
        if($created)
        {
            return response('Salvo', 200)
                ->header('Content-Type', 'text/plain');
        }else
        {
            return response('Erro ao salvar', 204)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $update = $this->model->findOrFail($id);

        if($update->update($dataForm))
        {
            return response('Atualizado', 200)
                ->header('Content-Type', 'text/plain');
        }else
        {
            return response('Erro ao atualizar', 204)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->destroy($id))
        {
            return response('Deletado', 200)
                ->header('Content-Type', 'text/plain');
        }else
        {
            return response('Erro ao deletar', 204)
                ->header('Content-Type', 'text/plain');
        }
    }
}
