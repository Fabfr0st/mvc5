<h2>Liste des abonnés</h2>
<p>Nombre d'abonnés : <?= $count ?></p>
<a href="<?= $view->path('addAbo'); ?>">Ajouter un abonné</a>

<section class="abonnes">
  <?php foreach ($abonnes as $abonne) { ?>
    <div>
      <p><?= $abonne->nom ?></p>
      <p><?= $abonne->prenom ?></p>
      <p><?= $abonne->email ?></p>
      <p><?= $abonne->age ?> ans</p>
    </div>
    <ul>
      <li><a href="<?= $view->path('abonne',  [$abonne->id]); ?>">Show</a></li>
      <li><a href="<?= $view->path('editAbo',  [$abonne->id]); ?>">Edit</a></li>
      <li><a onclick="return confirm('Etes vous sur et certain de vouloir supprimer cet abonné ?')"href="<?= $view->path('delAbo',  [$abonne->id]); ?>">Delete</a></li>
    </ul>
  <?php } ?>
</section>