<?php

namespace App\Http\Controllers;

use App\Serie;

class SeriesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->className = 'serie';
        $this->class = Serie::class;
    }

}
