<?php

require 'bootstrap.php';

use app\Product;

$id = $argv[1];
$newName = $argv[2];

$product = $entityManager->find(Product::class, $id);
if ($product === null) {
    echo "Product $id does not exist.\n";
    exit(1);
}
$product->setName($newName);
$entityManager->flush();
