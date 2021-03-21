<?php

namespace App\Http\Controllers;

use App\Episode;

class EpisodesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->className = 'episode';
        $this->class = Episode::class;
    }

    public function getEpisodesPerSerie(int $serieId)
    {
        $episodes = Episode::query()->where('serie_id', $serieId)->paginate();
        return $episodes;
    }

}
