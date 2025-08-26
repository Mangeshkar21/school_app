<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable=[
        'user_id',
         'qualification',
         'specialization',
         'salary',
         'hire_date',
         'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
      public function clas(){
        return $this->hasMany(Clas::class);
    }
}
