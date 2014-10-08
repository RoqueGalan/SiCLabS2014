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
        <?php foreach ($this->listaPermisos as $key => $permiso): ?>
            <tr>
                <td><?php echo $permiso->getNombre(); ?></td>
                <td><?php echo $permiso->getDescripcion(); ?></td>
                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'permiso/editar/' . $permiso->getId(); ?>" class="btn btn-default"><i class="fa fa-lg fa-edit"></i></a> 
                        <a href="<?php echo ROOT . 'permiso/mostrar/' . $permiso->getId(); ?>"class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='fa fa-lg fa-remove'></i></a>
                           <a href='<?php echo ROOT . "permiso/eliminar/" . $permiso->getId(); ?>' 
                           class='btn btn-danger'><i class='fa fa-lg fa-check'></i></a>
                           </div>
                           </div>">
                            <i class="fa fa-lg fa-trash"></i>
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
