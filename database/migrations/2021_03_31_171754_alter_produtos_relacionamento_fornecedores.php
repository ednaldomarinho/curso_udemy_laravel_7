<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProdutosRelacionamentoFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //criando coluna em produtos que recebe a fk de fornecedores
        Schema::table('produtos', function(Blueprint $table){

            //insere um registro de fornecedor para estabelecer relacionamento
            //só se já tiver registros
            $fornecedor_id = DB::table('fornecedores')->insertGetId([
            'nome' => 'Forncedor Padrão SG',
            'site' => 'fornecedorpadraosg.com.br',
            'uf' => 'SP',
            'email' => 'contato@fornecedorpadraosg.com.br',
            ]);
            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
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
        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });
    }
}
