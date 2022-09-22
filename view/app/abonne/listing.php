<h2>Liste des abonnés</h2>
<p>Nombre d'abonnés : <?= $count ?></p>

<section class="abonnes">
  <?php foreach ($abonnes as $abonne) { ?>
    <div>
      <p><?= $abonne->nom ?></p>
      <p><?= $abonne->prenom ?></p>
      <p><?= $abonne->email ?></p>
      <p><?= $abonne->age ?> ans</p>
    </div>
  <?php } ?>
</section>