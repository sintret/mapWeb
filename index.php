<?php
include 'Query.php';

$mapApi = 'AIzaSyCk5J7ptj3Bn3x2usoWQRuRYga9utdki5c';
$applicationName = 'Infrastruktur BNPP';
$imagePath = 'http://gis-admin.sintret.com/images/location/';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title><?php echo $applicationName;?></title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo $applicationName;?></a>
                </div>

            </div>
        </nav>


        <div class="container-fluid">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-3">
                    <div class="well">
                        <form>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select id="kabupaten" class="form-control" data-url="ajax.php">
                                    <?php
                                    $kabupatens = Query::kabupatens();
                                    $num = 1;
                                    if ($kabupatens)
                                        foreach ($kabupatens as $kabupaten) {
                                            ?>
                                            <option value="<?php echo $kabupaten->id; ?>"  <?php if ($num == 1) echo "selected"; ?>><?php echo $kabupaten->name; ?></option>
                                            <?php
                                            $num++;
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select id="kecamatan" class="form-control" data-url="ajax.php">
                                    <?php
                                    $kecamatans = Query::kecamatans(6303);
                                    if ($kecamatans)
                                        foreach ($kecamatans as $kecamatans) {
                                            ?>
                                            <option value="<?php echo $kecamatans->id; ?>"><?php echo $kecamatans->name; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <select id="desa" class="form-control" data-url="ajax.php">
                                    <?php
                                    $desas = Query::desas(6303010);
                                    if ($desas)
                                        foreach ($desas as $desa) {
                                            ?>
                                            <option value="<?php echo $desa->id; ?>"><?php echo $desa->name; ?></option>
                                        <?php } ?>
                                </select>
                            </div>

                            <p>
                                <?php
                                $categories = Query::categories();
                                if ($categories) {
                                    echo '<label for="category">Kategori</label>';
                                    foreach ($categories as $k => $v) {
                                        ?>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"   checked="" class="category" name="category" id="<?php echo $k; ?>" value="<?php echo $k; ?>"><?php echo $v; ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php }
                            } ?>

                            <button type="button" id="go" class="btn btn-success">Go!</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-9">
                    <div id="map" style="height: 500px"></div>
                </div>

            </div>

            <hr>

            <footer>
                <p>© 2016 <?php echo $applicationName;?></p>
            </footer>
        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script src="js/form.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $mapApi;?>&callback=goMap" async defer></script>

    </body>
</html>