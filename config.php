<?php

$host = "ec2-52-5-110-35.compute-1.amazonaws.com";
$db = "dfshrm73187voc";
$user = "kwghlljgrgjxpa";
$password = "38cbea1d18d5dcdcc3be9a60a57a3fd1db2f264b100a01db73d08a4f3bb3c958";

new PDO("pgsql:host=$host;port=5432;dbname=$db;", $user, $password);
