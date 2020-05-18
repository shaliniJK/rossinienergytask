<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borne extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'power', 'num_borne', 'timestamp',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
