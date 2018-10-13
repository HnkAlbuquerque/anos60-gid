<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    protected $table = 'public.cartao';
    public $timestamps = false;
    protected $primaryKey = 'cc_id';
}
