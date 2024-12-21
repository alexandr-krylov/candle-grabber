<?php
/**
 *  Bootstrap_xml_mariadb.php
*/
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once 'vendor/autoload.php';

$config = ORMSetup::createXMLMetadataConfiguration(
    paths: [__DIR__ . '/config/xml'],
    isDevMode: true
);

$connection = DriverManager::getConnection(
    [
        'driver' => 'pdo_mysql',
        'dbname' => 'candle_grabber',
        'user' => 'user',
        'password' => 'example',
        'host' => 'candle-grabber-db',
    ],
    $config
);

$entityManager = new EntityManager($connection, $config);
