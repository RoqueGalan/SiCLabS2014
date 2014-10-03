<h2>Detalles</h2>

<div>
    <h4>Usuario: <?php echo $this->usuario->getRol()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->usuario->getId(); ?>
        </dd>

        <dt>
            Matricula
        </dt>
        <dd>
            <?php echo $this->usuario->getMatricula(); ?>
        </dd>
        
        <dt>
            Nombre(s)
        </dt>
        <dd>
            <?php echo $this->usuario->getNombre(); ?>
        </dd>
        
        <dt>
            Apellido(s)
        </dt>
        <dd>
            <?php echo $this->usuario->getApellido(); ?>
        </dd>
        
        <dt>
            Correo
        </dt>
        <dd>
            <?php echo $this->usuario->getCorreo(); ?>
        </dd>
        
        <dt>
            Contraseña
        </dt>
        <dd>
            <?php echo $this->usuario->getContrasena(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'rol/editar/' . $this->rol->getId(); ?>" class="btn btn-link">Editar</a> |
    <a href="<?php echo ROOT . 'permisoRol/index/' . $this->rol->getId(); ?>" class="btn btn-link">Ver Permisos</a> |
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

