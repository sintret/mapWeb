<?php

/*
 * @author : Andy Fitria
 * <sintret@gmail.com>
 * simple pdo class
 * http://sintret.com
 */

include 'Model.php';

class Query {

    public static function kabupatens() {
        $query = new Model();
        $query->find("kabupaten");
        $query->orderBy("name asc");

        //echo 'test'.$query->statement();exit(0);
        $result = $query->all();
        return $result;
    }

}
