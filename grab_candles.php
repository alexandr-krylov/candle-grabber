<?php

require_once 'bootstrap.php';

$fromDate = $argv[1];
$toDate = $argv[2];
$period = $argv[3];

$startDate = new \DateTime($fromDate);
$endDate = new \DateTime($toDate);

