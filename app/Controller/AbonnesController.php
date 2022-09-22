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

  public function  show($id)
  {
    $abonne = $this->isAbonneExist($id);
    $this->render(
      'app.abonne.show',
      ['abonne' => $abonne]
    );
  }

  private function isAbonneExist($id)
  {
    $abonne = AbonneModel::findById($id);
    if (empty($abonne)) {
      $this->Abort404();
    }
    return $abonne;
  }
}
