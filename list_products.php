<?php

require_once 'bootstrap.php';

use app\Product;

$productRepository = $entityManager->getRepository(Product::class);
$products = $productRepository->findAll();
foreach ($products as $product) {
    echo sprintf("-%s\n", $product->getName());
}
