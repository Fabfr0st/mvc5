<?php

$routes = array(
    array('home', 'default', 'index'),
    array('abonnes', 'abonnes', 'listing'),
    array('abonne', 'abonnes', 'show', ['id']),
    array('editAbo', 'abonnes', 'edit', ['id'])
);
