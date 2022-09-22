<?php

namespace App\Controller;

use App\Model\AbonneModel;
use App\Service\Validation;
use App\Service\Form;
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

  public function delete($id)
  {
    $abonne = $this->isAbonneExist($id);
    AbonneModel::delete($id);
    $this->redirect('abonnes');
  }

  public function add()
  {
    $errors = [];
    if (!empty($_POST['submitted'])) {
      $post = $this->cleanXss($_POST);
      $valider = new Validation();
      $errors = $this->validAbonne($errors, $valider, $post);
      if ($valider->IsValid($errors)) {
        AbonneModel::insert($post);
        $this->redirect('abonnes');
      }
    }
    $form = new Form($errors);
    $this->render('app.abonne.add', ['form' => $form]);
  }

  public function edit($id)
  {
    $abonne = $this->isAbonneExist($id);
    $errors = [];
    if (!empty($_POST['submitted'])) {
      $post = $this->cleanXss($_POST);
      $v = new Validation();
      $errors = $this->validAbonne($errors, $v, $post);
      if ($v->IsValid($errors)) {
        AbonneModel::update($post, $id);
        $this->redirect('abonnes');
      }
    }
    $form = new Form($errors);
    $this->render('app.abonne.edit', [
      'abonne'  => $abonne,
      'form' => $form
    ]);
  }

  private function validAbonne($errors, $valider, $post)
  {
    var_dump($errors);
    $errors['nom'] = $valider->textValid($post['nom'], 'nom', 3, 100);
    $errors['prenom'] = $valider->textValid($post['prenom'], 'prenom', 3, 100);
    $errors['email'] = $valider->emailValid($post['email']);
    if (!empty($post['age'])) {
      $filter_options = array(
        'options' => array('min_range' => 0)
      );
      if (filter_var($post['age'], FILTER_VALIDATE_INT, $filter_options) === FALSE) {
        $errors['age'] = 'Veuillez renseigner un entier positif';
      } elseif ($post['age'] > 150) {
        $errors['age'] = 'Menteur !';
      }
    } else {
      $errors['age'] = 'Veuillez renseigner un age';
    }
    return $errors;
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
