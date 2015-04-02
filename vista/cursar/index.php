<h2>Index</h2>
<h3><?php echo $this->curso->getAsignatura()->getNombre() . ' | ' . $this->curso->getCiclo()->getNombre(); ?></h3>

<p>
    <a href="<?php echo ROOT . 'cursar/nuevo/' . $this->curso->getId(); ?>" class="btn btn-link">Nuevo Cursar</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Curso</th>
            <th>Rol</th>
            <th>Usuario</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaCursar as $key => $cursar): ?>
            <tr>
                <td><?php echo $cursar->getCurso()->getAsignatura()->getNombre(); ?></td>
                <td><?php echo $cursar->getUsuario()->getRol()->getNombre(); ?></td>
                <td><?php echo $cursar->getUsuario()->getNombre() . " " . $cursar->getUsuario()->getApellido(); ?></td>
                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'cursar/editar/' . $cursar->getId(); ?>" class="btn btn-default"><i class="fa fa-lg fa-edit"></i></a> 
                        <a href="<?php echo ROOT . 'cursar/mostrar/' . $cursar->getId(); ?>"class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='fa fa-lg fa-remove'></i></a>
                           <a href='<?php echo ROOT . "cursar/eliminar/" . $cursar->getId(); ?>' 
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
