<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getIdTertinggiAttribute(){
        return static::max('id');
    }

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }

    public function answer(){
        return $this->hasMany(Answer::class);
    }

}
