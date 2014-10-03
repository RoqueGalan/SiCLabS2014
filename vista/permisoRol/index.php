<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'permisoRol/nuevo'; ?>" class="btn btn-link">Asignar Permiso a Rol</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Nombre del Rol</th>
            <th>Nombre del Permiso</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaPermisosRol as $key => $tipoEspacio): ?>
            <tr>
                <td><?php echo $tipoEspacio->getRol()->getNombre(); ?></td>
                <td><?php echo $tipoEspacio->getPermiso()->getNombre(); ?></td>
                <td><?php echo $tipoEspacio->getEstado(); ?></td>
                <td>
                    <a href="<?php echo ROOT . 'permisoRol/editar/' . $tipoEspacio->getId(); ?>">Editar</a> | 
                    <a href="<?php echo ROOT . 'permisoRol/mostrar/' . $tipoEspacio->getId(); ?>" >Mostrar</a> | 
                    <a href="<?php echo ROOT . 'permisoRol/eliminar/' . $tipoEspacio->getId(); ?>" >Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($this->paginacion)) echo $this->paginacion; ?>

<p>
  <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link">  
</p>