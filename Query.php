<?php

/*
 * @author : Andy Fitria
 * <sintret@gmail.com>
 * simple pdo class
 * http://sintret.com
 */

include 'Model.php';

class Query {

    public static function kabupatens()
    {
        $query = new Model();
        $query->find("kabupaten");
        $query->orderBy("name asc");

        //echo 'test'.$query->statement();exit(0);
        $result = $query->all();
        return $result;
    }

    public static function kecamatans($kabupatenId = NULL)
    {

        $query = new Model();
        $query->find("kecamatan");

        if ($kabupatenId)
            $query->where(['kabupatenId' => $kabupatenId]);

        $query->orderBy("name asc");

        $result = $query->all();
        return $result;
    }

    public static function desas($kecamatanId = NULL)
    {

        $query = new Model();
        $query->find("desa");

        if ($kecamatanId)
            $query->where(['kecamatanId' => $kecamatanId]);

        $query->orderBy("name asc");

        $result = $query->all();
        return $result;
    }

    public static function categories()
    {

        $query = new Model();
        $query->find("category");
        $query->orderBy("name asc");

        $result = $query->all();
        return $result;
    }

}
