<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
      'user_id',
      'academic_id',
      'clas_id',
      'section_id',
      'roll_number',
      'admission_date',
      'dob',
      'gender',
      'blood_group',
      'address',
      'parent_name',
      'parent_contact',
      'status'
    ];

   public function academic()
{
    return $this->belongsTo(Academic::class, 'academic_id');
}

    public function clas(){
      return $this->belongsTo(Clas::class);
    }
    public function user(){
      return $this->belongsTo(User::class);
    }
    public function section(){
      return $this->belongsTo(Section::class);
    }
}
