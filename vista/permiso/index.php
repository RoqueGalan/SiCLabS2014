<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'permiso/nuevo'; ?>" class="btn btn-link">Nuevo Permiso</a>
</p>

<table class="table table-hover table-striped">
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
                    <div class="btn-group btn-group-sm">
                        <a href="<?php echo ROOT . 'permiso/editar/' . $rol->getId(); ?>" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        <a href="<?php echo ROOT . 'permiso/mostrar/' . $rol->getId(); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Mostrar</a>
                        <a href="<?php echo ROOT . 'permiso/eliminar/' . $rol->getId(); ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>


<p>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>
