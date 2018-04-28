<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    protected $table = 'cards';

    protected $fillable = ['suit', 'value', 'readable'];
}
