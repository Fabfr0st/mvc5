<?php

namespace App\Controller;

use App\Model\ProduitModel;
use App\Service\Validation;
use App\Service\Form;
use App\Weblitzer\Controller;

class ProduitsController extends Controller
{
  public function listing()
  {
    $produits = ProduitModel::all();
    $count = ProduitModel::count();
    $this->render('app.produit.listing', [
      'produits' => $produits,
      'count' => $count
    ]);
  }

  public function  show($id)
  {
    $produit = $this->isProduitExist($id);
    $this->render(
      'app.produit.show',
      ['produit' => $produit]
    );
  }

  public function delete($id)
  {
    $produit = $this->isProduitExist($id);
    ProduitModel::delete($id);
    $this->redirect('produits');
  }

  public function add()
  {
    $errors = [];
    if (!empty($_POST['submitted'])) {
      $post = $this->cleanXss($_POST);
      $valider = new Validation();
      $errors = $this->validProduit($errors, $valider, $post);
      if ($valider->IsValid($errors)) {
        ProduitModel::insert($post);
        $this->redirect('produits');
      }
    }
    $form = new Form($errors);
    $this->render('app.produit.add', ['form' => $form]);
  }

  public function edit($id)
  {
    $produit = $this->isProduitExist($id);
    $errors = [];
    if (!empty($_POST['submitted'])) {
      $post = $this->cleanXss($_POST);
      $v = new Validation();
      $errors = $this->validProduit($errors, $v, $post);
      if ($v->IsValid($errors)) {
        ProduitModel::update($post, $id);
        $this->redirect('produits');
      }
    }
    $form = new Form($errors);
    $this->render('app.produit.edit', [
      'produit'  => $produit,
      'form' => $form
    ]);
  }

  private function validProduit($errors, $valider, $post)
  {
    $errors['titre'] = $valider->textValid($post['titre'], 'titre', 1, 100);
    $errors['reference'] = $valider->textValid($post['reference'], 'reference',  1, 100);
    $errors['description'] = $valider->textValid($post['description'], 'description', 1, 100);
    return $errors;
  }

  private function isProduitExist($id)
  {
    $produit = ProduitModel::findById($id);
    if (empty($produit)) {
      $this->Abort404();
    }
    return $produit;
  }
}
