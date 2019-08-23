<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Balance;

//Saldo conta
class BalanceController extends Controller
{
    public function index(){

        //debug. Pega todos os dados do usuário logado
            //->balance->get() pega o resultado da função balance da model User
        //dd( auth()->user()->balance()->get() );

        //Variável para receber a relação do usuário e saldo (função balance de User)
        $balance = auth()->user()->balance;

        //dd($balance->amount);

        //se $balance for diferente de null então amount recebe o valor da coluna amount armazenada na tabela balance
            //senão rececbe 0
        $amount = $balance ? $balance->amount : 0;

        //chama view e passa o valor de $amount para a view, através do compact
        return view('admin.balance.index', compact('amount'));
    }

    //função que será acessada pela rota deposit (get), renomeada para balance.deposit    
    public function deposit(){
        //retorna view em resources/views/admin/balance/deposit.blade.php
        return view('admin.balance.deposit');
    }

    //será acessada pela rota deposit (post), renomeada para deposit.store
        //Utiliza a model Balance para chamar sua função de deposito (deposit())
    public function depositStore(Request $request){
        //debug
        //dd($request->all());
        //dd($request->value);
        //firstOrCreate verifica se existe algum valor na coluna, se não existir cria um valor. Se existir recupera o valor
        //dd( auth()->user()->balance()->firstOrCreate([]) );

        //recupera saldo atual do usuário
        $balance = auth()->user()->balance()->firstOrCreate([]);

        //Chama model Balance e utiliza sua função deposit, passando o value que veio do request de deposit.blade.php
        dd( $balance->deposit($request->value) );


    }

}
