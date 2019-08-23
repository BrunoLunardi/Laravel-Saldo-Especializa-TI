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

        //atualiza valor do saldo
        $this->amount += number_format($value, 2, '.', '');
        //salva valor no BD
        $deposit = $this->save();

        //Verifica se inseriu com sucesso
        if($deposit){
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
