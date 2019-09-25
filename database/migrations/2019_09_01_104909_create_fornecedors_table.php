<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cnpj');
            $table->string('inscricao_estadual');
            $table->string('inscricao_municipal');
            $table->unsignedBigInteger('servico_id')->unsigned();
            $table->string('tags');
            $table->string('contato')->nullable();
            $table->string('cargo')->nullable();
            $table->string('telefone1')->nullable();
            $table->string('telefone2')->nullable();
            $table->string('telefone3')->nullable();
            $table->string('email')->nullable();
            $table->string('redes_sociais')->nullable();
            $table->string('rua')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->text('description')->nullable();
            $table->integer('avalicao_preco')->default(0);
            $table->integer('avalicao_servico')->default(0);
            $table->timestamps();

            $table->foreign('servico_id')
                ->references('id')
                ->on('servicos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedors');
    }
}
