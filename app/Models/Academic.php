<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    protected $table = 'academics';

    protected $fillable = [
        'year_name',
        'start_date',
        'end_date',
        'status',
    ];

    public function clas(){
        return $this->hasMany(Clas::class);
    }
}
