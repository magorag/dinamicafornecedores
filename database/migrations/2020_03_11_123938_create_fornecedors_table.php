<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('cnpj')->unique();
            $table->string('inscricao_estadual')->nullable();
            $table->string('inscricao_municipal')->nullable();
            $table->string('servico');
            $table->string('tags')->nullable();
            $table->string('contato');
            $table->string('cargo');
            $table->string('telefone1');
            $table->string('telefone2')->nullable();
            $table->string('telefone3')->nullable();
            $table->string('email');
            $table->string('redes_sociais')->nullable();
            $table->string('rua');
            $table->string('bairro');
            $table->string('cidade');
            $table->unsignedBigInteger('estado_id')->unsigned();
            $table->text('description')->nullable();
            $table->integer('avalicao_preco')->default(0);
            $table->integer('avalicao_servico')->default(0);
            $table->string('userupdate')->nullable();
            $table->timestamps();

            $table->foreign('estado_id')
                ->references('id')
                ->on('estados')
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
