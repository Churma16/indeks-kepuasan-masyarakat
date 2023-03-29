<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // satu pertanyaan memiliki satu kuesioner
    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
}
