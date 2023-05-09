<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Questionnaire extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the number of questions in the questionnaire.
     *
     * @return int
     */
    public function getJumlahPertanyaanAttribute()
    {
        return $this->question()->count();
    }

    /**
     * Get the expiration date of the questionnaire in a new format.
     *
     * @return string
     */
    public function getWaktuEkspirasiBaruAttribute()
    {
        $dateold = $this->waktu_ekspirasi;
        $datenew = date('d F Y', strtotime($dateold));
        return $datenew;
    }

    /**
     * Get the expiration date of the questionnaire in a new format using Carbon.
     *
     * @return string
     */
    public function getWaktuEkspirasiNewAttribute()
    {
        return Carbon::parse($this->waktu_ekspirasi)->format('d-m-Y');
    }

    /**
     * Get the creation date of the questionnaire in a new format using Carbon.
     *
     * @return string
     */
    public function getWaktuPembuatanNewAttribute()
    {
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    /**
     * Get the questions for the questionnaire.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function question()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the respondents for the questionnaire.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function respondent()
    {
        return $this->hasMany(Respondent::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'link';
    }
}
