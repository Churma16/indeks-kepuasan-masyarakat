<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Questionnaire extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //  ACCESSOR
    public function getJumlahPertanyaanAttribute()
    {
        return $this->question()->count();
    }

    public function getWaktuEkspirasiBaruAttribute()
    {
        $dateold = $this->waktu_ekspirasi;
        $datenew = date('d F Y', strtotime($dateold));
        return $datenew;
    }

    // using carbon
    public function getWaktuEkspirasiNewAttribute()
    {
        return Carbon::parse($this->waktu_ekspirasi)->format('d-m-Y');
    }

    public function getWaktuPembuatanNewAttribute()
    {
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    //  RELATIONSHIP
    // satu kuesioner memiliki banyak pertanyaan
    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function respondent()
    {
        return $this->hasMany(Respondent::class);
    }

    //  MUTATOR
    public function getRouteKeyName()
    {
        return 'link';
    }
}
