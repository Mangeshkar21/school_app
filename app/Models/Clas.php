<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    protected $table = "clas";

    protected $fillable =[
        
       'academic_id',
       'clas_name',
       'clas_code',
       'teacher_id',
       'max_students',
       'status'
    ];

    public function academic(){
        return $this->belongsTo(Academic::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
