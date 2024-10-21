<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src'],
    isDevMode: true
);
$connection = DriverManager::getConnection([
    'driver' => $_ENV['DB_DRIVER'],
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => 'user',
    'password' => 'example',
    'host' => 'candle-grabber-db',
    // 'driver' => 'pdo_sqlite',
    // 'path' => __DIR__ . '/db.sqlite',
], $config);
$entityManager = new EntityManager($connection, $config);
