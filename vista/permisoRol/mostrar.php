<h2>Detalles</h2>

<div>
    <h4>Permiso-Rol</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>Id</dt><dd><?php echo $this->permisoRol->getId(); ?></dd>
        
        <dt>Rol</dt><dd><?php echo $this->permisoRol->getRol()->getNombre(); ?></dd>

        <dt>Permiso</dt><dd><?php echo $this->permisoRol->getPermiso()->getNombre(); ?></dd>

        <dt>Descripción</dt><dd><?php echo $this->permisoRol->getPermiso()->getDescripcion(); ?></dd>

        <dt>Estado</dt><dd><?php echo $this->permisoRol->getEstado(); ?></dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'permisoRol/editar/' . $this->permisoRol->getId(); ?>">Editar</a> | 
    <a href="<?php echo ROOT . 'permisoRol/index/'; ?>">Volver a la Lista</a> | 
</p>