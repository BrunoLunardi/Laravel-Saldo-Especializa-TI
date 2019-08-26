<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//para utilizar método de banco de dados (transações, por exemplo)
use DB;

class Balance extends Model
{
    //para desativar o timestamps desta tabela
    public $timestamps = false;

    //função para deposito (retorna um array)
    public function deposit(float $value) : Array{

        //Inicializa transação do banco de dados (ou toda operação é executada ou nada será executado)
        DB::beginTransaction();

        //saldo atual
        //$this é o objeto de balance vindo do controller
        //dd($this->amount);
        //dd($value);

        //variavel para receber o valor antes do deposito
            //primeiro verifica se a variavel é null, caso for altera para 0, pois 
                //historico total_before não aceita valor null
        $totalBefore = $this->amount ? $this->amount : 0;
        //atualiza valor do saldo
        $this->amount += number_format($value, 2, '.', '');
        //salva valor no BD
        $deposit = $this->save();

        //pega usuário logado (objeto de usuário) junto com o relacionamento de usuario e historico (está na model User o historics())
        //método create() necessita criar o $fillable em Historic 
            //(para garantir que os dados corretos sejam inseridos no bd)
            //create() retorna true ou false
        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
        ]);

        //Verifica se inseriu com sucesso o deposito e o historico
        if($deposit && $historic){

            //realiza commit dos dados
            DB::commit();


            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        }else{

            //se der erro ao inserir dados, realiza rollback
            DB::rollback();

            //se não inseriu com sucesso
            return [
                'success' => false,
                'message' => 'Falha ao recarregar'
            ];

        }

    }

}
