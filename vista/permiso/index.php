<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'permiso/nuevo'; ?>" class="btn btn-link">Nuevo Permiso</a>
</p>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nombre del Permiso</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($this->listaPermisos as $key => $rol): ?>
            <tr>
                <td><?php echo $rol->getNombre(); ?></td>
                <td><?php echo $rol->getDescripcion(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'permiso/editar/' . $rol->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'permiso/mostrar/' . $rol->getId(); ?>">Mostrar</a> | 
                    <a href="<?php echo ROOT . 'permiso/eliminar/' . $rol->getId(); ?>">Eliminar</a>
                    
                   
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
