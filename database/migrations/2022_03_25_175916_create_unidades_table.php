<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            //colunas
            $table->id();
            $table->string('unidade', 5); //cm, mm, kg
            $table->string('descricao', 30);
            $table->timestamps();
        });

       //adicionar relacionamento com a table produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });

        //adicionar relacionamento com a table produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Remover relacionamento com a table produto_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            //Remover a FK
            $table->dropForeign('produto_detalhes_unidade_id_foreign'); //[table]_[coluna]_foreign
            //Remover a coluna unidade_id
            $table->dropColumn('unidade_id');
        });
        //Remover relacionamento com a table produtos
        Schema::table('produtos', function (Blueprint $table) {
            //Remover a FK
            $table->dropForeign('produtos_unidade_id_foreign'); //[table]_[coluna]_foreign
            //Remover a coluna unidade_id
            $table->dropColumn('unidade_id');
        });

        //Remover tabela unidades
        Schema::dropIfExists('unidades');
    }
};
