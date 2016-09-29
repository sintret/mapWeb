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
        $query = new Model;
        return $query->find("kabupaten")->orderBy("name asc")->all();
    }

    public static function kecamatans($kabupatenId = NULL)
    {

        $query = new Model;
        $query->find("kecamatan")->orderBy("name asc");

        if ($kabupatenId)
            $query->where(['kabupatenId' => $kabupatenId]);

        return $query->all();
    }

    public static function desas($kecamatanId = NULL)
    {

        $query = new Model;
        $query->find("desa")->orderBy("name asc");

        if ($kecamatanId)
            $query->where(['kecamatanId' => $kecamatanId]);

        return $query->all();
    }

    public static function categories()
    {
        $return = [];
        $query = new Model;
        $models = $query->find("category")->orderBy("name asc")->all();
        if ($models)
            foreach ($models as $model) {
                $return[$model->id] = $model->name;
            }

        return $return;
    }

    public static $colors = ['28AD1F', 'FAC800', 'D1111A', '28AD1F', 'FAC800', 'D1111A', '28AD1F', 'FAC800', 'D1111A'];
    public static $icons = ['kesehatan.png', 'kesehatan.png', 'pendidikan.png', 'perdagangan.png'];

    public static function locations($desaId, $category = [])
    {
        $return = [];
        $query = new Model;
        $results = $query->find("location")->where(['desaId' => $desaId])->all();

        if ($results)
            foreach ($results as $result) {

                if (in_array($result->categoryId, $category)) {
                    $json = "";
                    $m = null;
                    $color = 'image/' . self::$icons[$result->categoryId];
                    $image = $result->image;
                    $m = new Model();
                    $m->find('location_photo')->where(['locationId' => $result->id]);
                    $models = $m->all();
                    if ($models) {
                        foreach ($models as $model) {
                            $return['images'][$result->id][] = self::resolvedImage($model->image);
                        }

                        //$return['images'][$result->id][] = self::resolvedImage($result->image);
                        $json = implode("aaiiaa", $return['images'][$result->id]);
                    }

                    $return['id'] = $result->id;

                    $location = floatval($result->latitude) . ',' . floatval($result->longitude);
                    $return['markers'][] = [$result->name, $result->description, floatval($result->latitude), floatval($result->longitude), $num, $color, $json];
                    $return['contents'][] = ['<div class="info_content"><h3>' . $result->name . '</h3><p> No Description </p></div>'];
                    if ($result->latitude)
                        $lat = $result->latitude;
                    if ($result->longitude)
                        $lon = $result->longitude;
                }
            }


        $new = new Model;
        $desa = $new->find('desa')->where(['id' => $desaId])->one();

        $lat = empty($lat) ? $desa->latitude : $lat;
        $lon = empty($lon) ? $desa->longitude : $lon;
        $return['lat'] = $lat;
        $return['lon'] = $lon;

        return $return;
    }

    public static function resolvedImage($image = NULL)
    {
        //$return = 'image/noimage.png';
        if ($image) {
            $path = 'http://gis-admin.sintret.com';
            $return = str_replace('@web', $path, $image);

            $basename = basename($return);


            $return = str_replace($basename, 'thumb/' . $basename, $return);
            $return = str_replace('/', 'iiuuii', $return);
        }

        return $return;
    }

}
