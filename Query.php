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
        return $query->find("kabupaten")->orderBy("name asc")->all();
    }

    public static function kecamatans($kabupatenId = NULL)
    {

        $query = new Model();
        $query->find("kecamatan")->orderBy("name asc");

        if ($kabupatenId)
            $query->where(['kabupatenId' => $kabupatenId]);

        return $query->all();
    }

    public static function desas($kecamatanId = NULL)
    {

        $query = new Model();
        $query->find("desa")->orderBy("name asc");

        if ($kecamatanId)
            $query->where(['kecamatanId' => $kecamatanId]);

        return $query->all();
    }

    public static function categories()
    {
        $query = new Model();
        return $query->find("category")->orderBy("name asc")->all();
    }

    public static $colors = ['28AD1F', 'FAC800', 'D1111A', '28AD1F', 'FAC800', 'D1111A', '28AD1F', 'FAC800', 'D1111A'];

    public static function locations($desaId)
    {
        $return = [];
        $query = new Model;
        $results = $query->find("location")->where(['desaId' => $desaId])->all();

        if ($results)
            foreach ($results as $result) {
                $color = self::$colors[$result->categoryId];
                $location = floatval($result->latitude) . ',' . floatval($result->longitude);
                $return['markers'][] = [$result->name, "No Description", floatval($result->latitude), floatval($result->longitude), $num, $color];
                $return['contents'][] = ['<div class="info_content"><h3>' . $result->name . '</h3><p> No Description </p></div>'];
                if ($result->latitude)
                    $lat = $result->latitude;
                if ($result->longitude)
                    $lon = $result->longitude;
                $num++;
                $count++;
            }

        $return['lat'] = $lat;
        $return['lon'] = $lon;

        return $return;
    }

}
