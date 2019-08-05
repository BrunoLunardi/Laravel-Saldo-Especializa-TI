<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabela para históricos de transações de usuários
        Schema::create('historics', function (Blueprint $table) {
            $table->increments('id');
            //unsigned para criar chave estrangeira
            $table->integer('user_id')->unsigned();
            //define relacionamento de chave estrangeira, com a tabela users
                //sendo id da tabela user a chave primaria e user_id a estrangeira desta tabela
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //Tipo da movimentação
                //I -> Entrada
                //O -> Saida
                //T -> Transferencia
            $table->enum('type', ['I', 'O', 'T']);
            //Total movimentado
            $table->double('amount', 10,2);
            //dados de historico de transação
            $table->double('total_before', 10, 2);
            $table->double('total_after', 10, 2);
            //Preenchimento opcional
            $table->integer('user_id_transaction')->nullable();
            //data de transação (apesar de ja existir o timestamps, optou por criar este campo)
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historics');
    }
}
