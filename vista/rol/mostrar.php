<h2>Detalles</h2>

<div>
    <h4>Rol</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>

        <dd>
            <?php echo $this->rol->getId(); ?>
        </dd>

        <dt>
            Nombre
        </dt>

        <dd>
            <?php echo $this->rol->getNombre(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'rol/editar/' . $this->rol->getId(); ?>">Editar</a> |
    <a href="<?php echo ROOT . 'permisoRol/index/' . $this->rol->getId(); ?>">Ver Permisos</a> |
    <a href="<?php echo ROOT . 'rol/index/';?>">Volver a la Lista</a>
</p>