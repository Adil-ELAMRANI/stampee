<?php

namespace App\Controllers;

use App\Models\Timbre;
use App\Providers\View;

class CatalogueController
{
    public function index()
    {
        $timbreModel = new Timbre();
        $timbres = $timbreModel->all(); 

        return View::render('catalogue/index', ['timbres' => $timbres]);
    }
}
