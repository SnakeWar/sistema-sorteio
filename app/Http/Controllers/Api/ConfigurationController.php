<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Http\Resources\ConfigurationResource;
use App\Models\Configuration;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    /**
     * @var Game
     */
    private $model;

    public function __construct(Configuration $model)
    {
        $this->model = $model;
    }

    public function index()
    {

        $lotofacil = $this->model->where('numero_concurso', 1835);
        $today = \Helper::convertdata_tosite(Carbon::now());
        $last_update = \Helper::convertdata_tosite($lotofacil->first()->updated_at);
        if ($today != $last_update) {
            $nome = 'lotofacil';
            $token = '2ATj92eJ4TLClX0';
            $consurso = '1835';
            $urlApi = 'http://apiloterias.com.br/app/resultado?loteria=' . $nome . '&token=' . $token . '&concurso=' . $consurso;

            $res = file_get_contents($urlApi);
            $data = json_decode($res);
            $data = (array)$data;
            $lotofacil->update([
                'nome' => $data['nome'],
                'numero_concurso' => $data['numero_concurso'],
                'data_concurso' => $data['data_concurso'],
                'arrecadacao_total' => $data['arrecadacao_total'],
                'dezenas' => implode(",", $data['dezenas']),
                'local_realizacao' => $data['local_realizacao'],
                'rateio_processamento' => $data['rateio_processamento'],
                'acumulou' => $data['acumulou']
            ]);
        }
        return $lotofacil->first();
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
        if ($created) {
            return response('Salvo', 200)
                ->header('Content-Type', 'text/plain');
        } else {
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

        if ($update->update($dataForm)) {
            return response('Atualizado', 200)
                ->header('Content-Type', 'text/plain');
        } else {
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
        if ($model->destroy($id)) {
            return response('Deletado', 200)
                ->header('Content-Type', 'text/plain');
        } else {
            return response('Erro ao deletar', 204)
                ->header('Content-Type', 'text/plain');
        }
    }
}
