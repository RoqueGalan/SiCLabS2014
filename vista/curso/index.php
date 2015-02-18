<h2>Index</h2>
<h3><?php echo $this->espacio->getNombre(); ?></h3>

<p>
    <a href="<?php echo ROOT . 'curso/nuevo/'. $this->espacio->getId(); ?>" class="btn btn-link">Nuevo Curso</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Unidad de Aprendizaje</th>
            <th>Carrera</th>
            <th>Grupo</th>
            <th>Ciclo</th>
            <th>Descripción</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaCursos as $key => $curso): ?>
            <tr>
                <td><?php echo $curso->getUda()->getAsignatura()->getNombre(); ?></td>
                <td><?php echo $curso->getUda()->getCarrera()->getNombre(); ?></td>
                <td><?php echo $curso->getGrupo()->getNombre(); ?></td>
                <td><?php echo $curso->getCiclo()->getNombre(); ?></td>
                <td><?php echo $curso->getDescripcion(); ?></td>
                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'curso/editar/' . $curso->getId(); ?>" class="btn btn-default"><i class="fa fa-lg fa-edit"></i></a> 
                        <a href="<?php echo ROOT . 'curso/mostrar/' . $curso->getId(); ?>"class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='fa fa-lg fa-remove'></i></a>
                           <a href='<?php echo ROOT . "curso/eliminar/" . $curso->getId(); ?>' 
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
