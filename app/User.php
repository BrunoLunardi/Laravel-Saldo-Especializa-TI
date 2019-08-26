<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

//chama model para relacionamento 1 para 1
use App\Models\Balance;
//chama model para relacionamento 1 para n
use App\Models\Historic;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //saldo do usuário
    public function balance(){
        //Relacionamento 1 para 1 entre Usuário e o Saldo (User - Balance)
        return $this->hasOne(Balance::class);
    }

    //historico de movimentação do usuário
    public function historics(){
        //delimita a relação de 1 para n, na qual um usuário tem vários históricos de transações
        return $this->hasMany(Historic::class);
    }

}
