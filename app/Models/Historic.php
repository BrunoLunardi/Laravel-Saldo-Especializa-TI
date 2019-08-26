<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//historico do usuário
class Historic extends Model
{
    //variável que garante quais dados serão inseridos (pelo create que esta na model Balance, método deposit)
    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];
}
