<?php

namespace App\Observers;

use App\Models\Respondent;
use Illuminate\Support\Facades\Cache;

class RespondentObserver
{
    /**
     * Handle the Respondent "created" event.
     *
     * @param  \App\Models\Respondent  $respondent
     * @return void
     */
    public function created(Respondent $respondent)
    {
        Cache::forget('stats_questionnaire_' . $respondent->questionnaire_id);
    }

    /**
     * Handle the Respondent "updated" event.
     *
     * @param  \App\Models\Respondent  $respondent
     * @return void
     */
    public function updated(Respondent $respondent)
    {
        //
    }

    /**
     * Handle the Respondent "deleted" event.
     *
     * @param  \App\Models\Respondent  $respondent
     * @return void
     */
    public function deleted(Respondent $respondent)
    {
        //
    }

    /**
     * Handle the Respondent "restored" event.
     *
     * @param  \App\Models\Respondent  $respondent
     * @return void
     */
    public function restored(Respondent $respondent)
    {
        //
    }

    /**
     * Handle the Respondent "force deleted" event.
     *
     * @param  \App\Models\Respondent  $respondent
     * @return void
     */
    public function forceDeleted(Respondent $respondent)
    {
        //
    }
}
