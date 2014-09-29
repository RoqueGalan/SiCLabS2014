<h2>Detalles</h2>

<div>
    <h4>Permiso</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>Id</dt><dd><?php echo $this->permiso->getId(); ?></dd>

        <dt>Nombre</dt><dd><?php echo $this->permiso->getNombre(); ?></dd>
        
        <dt>Descripción</dt><dd><?php echo $this->permiso->getDescripcion(); ?></dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'permiso/editar/' . $this->permiso->getId(); ?>">Editar</a> | 
    <a href="<?php echo ROOT . 'permiso/index/';?>">Volver a la Lista</a>
</p>