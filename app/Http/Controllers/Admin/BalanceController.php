<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Model
use App\Models\Balance;
//Utilizar o request (validação de campo)
use App\Http\Requests\MoneyValidationFormRequest;
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
    //em vez de utilizar o Request padrão, utiliza o MoneyValidationFormRequest
        //pois este terá regras personalizadas, como campo obrigatório e numérico
            //na view deposit.blade.php deve colocar uma variavel para mensagem de erro
    public function depositStore(MoneyValidationFormRequest $request){
        //debug
        //dd($request->all());
        //dd($request->value);
        //firstOrCreate verifica se existe algum valor na coluna, se não existir cria um valor. Se existir recupera o valor
        //dd( auth()->user()->balance()->firstOrCreate([]) );

        //recupera saldo atual do usuário
        $balance = auth()->user()->balance()->firstOrCreate([]);
        //Chama model Balance e utiliza sua função deposit, passando o value que veio do request de deposit.blade.php
        $reponse = $balance->deposit($request->value);
        //verifica se a função deposit, da model Balance, retornou true
        if($reponse['success']){
            //rota para exibição do saldo
            //passa a mensagem que foi definida no retorno da função deposit
            return redirect()->route('admin.balance')->with('success', $reponse['message']);
        }
        //Chama model Balance e utiliza sua função deposit, passando o value que veio do request de deposit.blade.php
        //dd( $balance->deposit($request->value) );

        //volta para a página que chamou o controller e passa a mensagem de erro
        return redirect()->back()->with('error', $reponse['message']);

    }

    //função que será acessada pela rota deposit (get), renomeada para balance.withdrawn
    public function withdraw(){
        return view('admin.balance.withdraw');
    }



    //será acessada pela rota withdraw (post), renomeada para withdrawn.store
        //Utiliza a model Balance para chamar sua função de deposito (deposit())
    //em vez de utilizar o Request padrão, utiliza o MoneyValidationFormRequest
        //pois este terá regras personalizadas, como campo obrigatório e numérico
            //na view deposit.blade.php deve colocar uma variavel para mensagem de erro
            public function withdrawStore(MoneyValidationFormRequest $request){
                //debug
                //dd($request->all());
                //dd($request->value);
                //firstOrCreate verifica se existe algum valor na coluna, se não existir cria um valor. Se existir recupera o valor
                //dd( auth()->user()->balance()->firstOrCreate([]) );
        
                //recupera saldo atual do usuário
                $balance = auth()->user()->balance()->firstOrCreate([]);
                //Chama model Balance e utiliza sua função withdraw, passando o value que veio do request de withdrawn.blade.php
                $reponse = $balance->withdraw($request->value);

                //verifica se a função withdraw, da model Balance, retornou true
                if($reponse['success']){
                    //rota para exibição do saldo
                    //passa a mensagem que foi definida no retorno da função deposit
                    return redirect()->route('admin.balance')->with('success', $reponse['message']);
                }
                //Chama model Balance e utiliza sua função deposit, passando o value que veio do request de deposit.blade.php
                //dd( $balance->deposit($request->value) );
        
                //volta para a página que chamou o controller e passa a mensagem de erro
                return redirect()->back()->with('error', $reponse['message']);
        
            }


}
