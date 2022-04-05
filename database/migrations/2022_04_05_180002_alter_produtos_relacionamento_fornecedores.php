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
        //Criando a coluna em produtos que vai receber a fk de fornecedores
        Schema::table('produtos', function (Blueprint $table) {
            //Insere um registro de fornecedor para estabelecer o relacionamento
            $fornecedor_id = DB::table('fornecedores')->insertGetId([
                'nome' => 'Fornecedor Padrão',
                'site' => 'fornecedorpadrao.com.br',
                'uf' => 'SP',
                'email' => 'fornecedorpadrao@gmail.com' 
            ]);
            //Criando a coluna fornecedor_id depois (after) do campo id
            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
            //Criando a chave estrangeira fornecedor_id que vai referenciar a tabela fornecedores pelo campo id
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            //Apaga a chave estrangeira fornecedor_id que vai referenciar a tabela fornecedores pelo campo id
            $table->dropForeign('produtos_fornecedor_id_foreign');
            //Apaga a coluna fornecedor_id depois (after) do campo id
            $table->dropColumn('fornecedor_id');
        });
        
    }
};
