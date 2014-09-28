<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= (isset($this->title)) ? $this->title : 'SiCLabS'; ?></title>

        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/default.css" />    
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/bootstrap-theme.min.css" />

    </head>

    <body>

        <header>
            <nav class="navbar navbar-default navbar-inverse" role="navigation">
                <div class="container">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-deslizable">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo ROOT; ?>">SiCLabS</a>
                    </div>

                    <div class="collapse navbar-collapse" id="menu-deslizable">

                        <ul class="nav navbar-nav">

                            <li><a href="<?php echo ROOT . 'rol'; ?>">Rol</a></li>

                        </ul>


                    </div> 

                </div>




            </nav>
        </header>


        <div  id="contenido" class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">



