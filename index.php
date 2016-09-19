<?php
include 'Query.php';
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

        <title>Map foe Web App</title>

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
                    <a class="navbar-brand" href="#">Map Web App</a>
                </div>

            </div>
        </nav>


        <div class="container-fluid">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-3">
                    <div class="well">
                        <form>
                            <?php //echo "<pre>"; print_r(Query::kabupatens());?>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select id="kabupaten" class="form-control" >
                                    <?php
                                    $kabupatens = Query::kabupatens();
                                    
                                    if ($kabupatens)
                                        foreach ($kabupatens as $kabupaten) {
                                            ?>
                                            <option value="<?php echo $kabupaten->id;?>"><?php echo $kabupaten->name;?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kecamatan</label>
                                <select id="kabupaten" class="form-control" >
                                    <option value="1">Bengkalis</option>
                                    <option value="1">Ternate</option>
                                    <option value="1">Tidore</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Desa</label>
                                <select id="kabupaten" class="form-control" >
                                    <option value="1">Bengkalis</option>
                                    <option value="1">Ternate</option>
                                    <option value="1">Tidore</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-9">
                    <h2>Heading</h2>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
                </div>

            </div>

            <hr>

            <footer>
                <p>© 2016 Company, Inc.</p>
            </footer>
        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-3.1.0.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    </body>
</html>