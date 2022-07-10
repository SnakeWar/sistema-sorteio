<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'numero_concurso' => $this->numero_concurso,
            'data_concurso' => $this->data_concurso,
            'data_concurso_milliseconds' => $this->data_concurso_milliseconds,
            'local_realizacao' => $this->local_realizacao,
            'rateio_processamento' => $this->rateio_processamento,
            'acumulou' => $this->acumulou,
            'valor_acumulado' => $this->valor_acumulado,
            'dezenas' => $this->dezenas,
            'arrecadacao_total' => $this->arrecadacao_total,
            'data_proximo_concurso' => $this->data_proximo_concurso,
            'data_proximo_concurso_milliseconds' => $this->data_proximo_concurso_milliseconds,
            'data_proximo_concurso_milliseconds' => $this->data_proximo_concurso_milliseconds,
            'valor_acumulado_especial' => $this->valor_acumulado_especial,
            'valor_acumulado_especial' => $this->valor_acumulado_especial,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
