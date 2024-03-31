<?php

require_once "bootstrap.php";

use app\Bug;

$theBugId = $argv[1];

$bug = $entityManager->find(Bug::class, (int)$theBugId);
$bug->close();
$entityManager->flush();
