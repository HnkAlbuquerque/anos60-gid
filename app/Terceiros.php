<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terceiros extends Model
{
    protected $table = 'public.terceiros';
    public $timestamps = false;
    protected $primaryKey = 'ter_id';
}
