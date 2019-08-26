<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //para desativar o timestamps desta tabela
    public $timestamps = false;

    //função para deposito (retorna um array)
    public function deposit(float $value) : Array{
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
            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        }

        //se não inseriu com sucesso
        return [
            'success' => false,
            'message' => 'Falha ao recarregar'
        ];

    }

}
