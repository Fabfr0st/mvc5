<?php

namespace App\Controller;

use App\Model\AbonneModel;
use App\Weblitzer\Controller;

class AbonnesController extends Controller
{
  public function listing()
  {
    $abonnes = AbonneModel::all();
    $count = AbonneModel::count();
    $this->render('app.abonne.listing', [
      'abonnes' => $abonnes,
      'count' => $count
    ]);
  }
}
