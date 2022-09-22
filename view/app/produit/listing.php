<h2>Liste des produits</h2>
<p>Nombre de produits : <?= $count ?></p>
<a href="<?= $view->path('addProd'); ?>">Ajouter un produit</a>

<section class="produits">
  <?php foreach ($produits as $produit) { ?>
    <div>
      <p><?= $produit->titre ?></p>
      <p><?= $produit->reference ?></p>
      <p><?= $produit->description ?></p>
    </div>
    <ul>
      <li><a href="<?= $view->path('produit',  [$produit->id]); ?>">Show</a></li>
      <li><a href="<?= $view->path('editProd',  [$produit->id]); ?>">Edit</a></li>
      <li><a onclick="return confirm('Etes vous sur et certain de vouloir supprimer ce produit ?')" href="<?= $view->path('delProd',  [$produit->id]); ?>">Delete</a></li>
    </ul>
  <?php } ?>
</section>