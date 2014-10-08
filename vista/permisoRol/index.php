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
        <?php foreach ($this->listaPermisosRol as $key => $permisoRol): ?>
            <tr>
                <td><?php echo $permisoRol->getRol()->getNombre(); ?></td>
                <td><?php echo $permisoRol->getPermiso()->getNombre(); ?></td>
                <td><?php echo $permisoRol->getEstado(); ?></td>
                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'permisoRol/editar/' . $permisoRol->getId(); ?>" class="btn btn-default"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="<?php echo ROOT . 'permisoRol/mostrar/' . $permisoRol->getId(); ?>"class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='glyphicon glyphicon-remove'></i></a>
                           <a href='<?php echo ROOT . "permisoRol/eliminar/" . $permisoRol->getId(); ?>' 
                           class='btn btn-danger'><i class='glyphicon glyphicon-ok'></i></a>
                           </div>
                           </div>">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
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