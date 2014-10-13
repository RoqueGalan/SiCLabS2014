<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= (isset($this->titulo)) ? $this->titulo : 'SiCLabS'; ?></title>
   
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/jquery-ui.min.css" />
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/jquery-ui.structure.min.css" />
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/bootstrap-dialog.min.css" />
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo ROOT; ?>public/css/default.css" /> 
        
        <!-- Insertar aqui los css a utilizar en el controlador-->
        <?php
        if (count($this->_css)) {
            foreach ($this->_css as $css) {
                echo '<link rel="stylesheet" href="' . $css . '"/>';
            }
        }
        ?>

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
                        <li><a href="<?php echo ROOT . 'rol/index'; ?>">Roles</a></li>
                        <li><a href="<?php echo ROOT . 'permiso/index'; ?>">Permisos</a></li>
                        <li><a href="<?php echo ROOT . 'permisoRol/index/1'; ?>">Permisos-Rol</a></li>
                        <li><a href="<?php echo ROOT . 'usuario/index'; ?>">Usuarios</a></li>
                        <li class="nav-divider"></li>
                        <li><a href="<?php echo ROOT . 'tipoEspacio/index'; ?>">Tipos Espacio</a></li>
                        <li><a href="<?php echo ROOT . 'espacio/index'; ?>">Espacio</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container body-content">