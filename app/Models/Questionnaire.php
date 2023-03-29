<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function getJumlahPertanyaanAttribute()
    // {
    //     return $this->questions()->count();
    // }

    // satu kuesioner memiliki banyak pertanyaan
    public function question(){
        return $this->hasMany(Question::class);
    }
}
