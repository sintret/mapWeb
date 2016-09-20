<?php

ini_set("dispaly_errors", 1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Query.php';


$kecamatans = Query::kecamatans();

//echo "<pre>"; print_r($kecamatans);



$query = new Model();
$query->find("category");
$result = $query->all();
echo "<pre>"; print_r($result);


