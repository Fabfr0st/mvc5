<?php

$routes = array(
    array('home', 'default', 'index'),
    array('abonnes', 'abonnes', 'listing'),
    array('abonne', 'abonnes', 'show', ['id']),
    array('editAbo', 'abonnes', 'edit', ['id']),
    array('delAbo', 'abonnes', 'delete', ['id']),
    array('addAbo', 'abonnes', 'add'),
    array('produits', 'produits', 'listing'),
    array('produit', 'produits', 'show', ['id']),
    array('editProd', 'produits', 'edit', ['id']),
    array('delProd', 'produits', 'delete', ['id']),
    array('addProd', 'produits', 'add')
);
