<?php

ini_set("dispaly_errors", 1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Query.php';


$kecamatans = Query::kecamatans();

if($kecamatans)
    foreach ($kecamatans as $kecamatans){
        
    }
