<?php

require_once 'bootstrap.php';

use app\Bug;

$theBugId = $argv[1];

$bug = $entityManager->find(Bug::class, (int)$theBugId);

echo "Bug: " . $bug->getDescription() . "\n";
echo "Engigeer: " . $bug->getEngineer()->getName() . "\n";
