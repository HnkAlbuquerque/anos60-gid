<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartaoProcess extends Model
{
    protected $table = 'public.cartao_process';
    public $timestamps = false;
    protected $primaryKey = 'cc_id';
}
