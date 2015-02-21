<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= (isset($this->title)) ? $this->title : 'SiCLabS'; ?></title>

        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/error.css" />    
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/bootstrap-theme.min.css" />

    </head>
    <body>

        <div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo ROOT; ?>">Siclabs</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo ROOT; ?>">Inicio</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container body-content">



