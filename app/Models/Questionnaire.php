<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getJumlahPertanyaanAttribute()
    {
        return $this->question()->count();
    }

    // satu kuesioner memiliki banyak pertanyaan
    public function question(){
        return $this->hasMany(Question::class);
    }
}
