<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nome')->nullable();
            $table->bigInteger('numero_concurso')->nullable();
            $table->dateTime('data_concurso')->nullable();
            $table->timestamp('data_concurso_milliseconds')->nullable();
            $table->string('local_realizacao')->nullable();
            $table->boolean('rateio_processamento')->nullable();
            $table->boolean('acumulou')->nullable();
            $table->bigInteger('valor_acumulado')->nullable();
            $table->text('dezenas')->nullable();
            $table->bigInteger('arrecadacao_total')->nullable();
            $table->dateTime('data_proximo_concurso')->nullable();
            $table->timestamp('data_proximo_concurso_milliseconds')->nullable();
            $table->bigInteger('valor_estimado_proximo_concurso')->nullable();
            $table->float('valor_acumulado_especial')->nullable();
            $table->string('nome_acumulado_especial')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
