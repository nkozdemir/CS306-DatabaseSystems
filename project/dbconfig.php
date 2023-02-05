<?php

    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;

    $factory = (new Factory)
        /* Firebase credential information, thus empty */
        //->withServiceAccount('')
        //->withDatabaseUri('');

    $database = $factory->createDatabase();

?>