<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';

    protected $fillable = [
       'class_id',
       'section_name',
       'max_students'
    ];

    public function clas(){
        return $this->belongsTo(Clas::class,'class_id');
    }
}
