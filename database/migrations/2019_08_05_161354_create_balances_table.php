<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabela com o saldo do usuário
        Schema::create('balances', function (Blueprint $table) {
            $table->increments('id');
            //desativa o created_at, deletead_ad
                //tem que criar uma variável timestamps no model Balance
            //$table->timestamps();
            
            //para trabalhar com chave estrangeira usa unsigned
                //pois campos autoincrements de chave primária são UNSIGNED (sem valor negativo)
            $table->integer('user_id')->unsigned();
            //define qual coluna é chave estrangeira (user_id)
                //a chave primaria desta estrangeira é a id da tabela users (com delete cascade)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //saldo final
            $table->double('amount', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balances');
    }
}
