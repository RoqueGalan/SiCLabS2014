<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'imagenNoticia/nuevo/' . $this->noticia->getId(); ?>" class="btn btn-link">Nueva Imagen de Noticia</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Operaciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaImagenNoticia as $key => $imagenNoticia): ?>
            <tr>
                <td>
                    <a href="#" class="imagenPop" data-toggle="modal" data-target="#ModalImagenPop" data-img-url="<?php echo ROOT . $imagenNoticia->getRuta() . $imagenNoticia->getImagen(); ?>">
                        <img src="<?php echo ROOT . $imagenNoticia->getRuta() . '/mini/mini_' . $imagenNoticia->getImagen(); ?>" class="img-thumbnail" />
                    </a>
                </td>

                <td><?php echo $imagenNoticia->getTitulo(); ?></td>
                <td><?php echo $imagenNoticia->getDescripcion(); ?></td>

                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'imagenNoticia/editar/' . $imagenNoticia->getId(); ?>" class="btn btn-default"><i class="fa fa-lg fa-edit"></i></a> 
                        <a href="<?php echo ROOT . 'imagenNoticia/mostrar/' . $imagenNoticia->getId(); ?>"class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='fa fa-lg fa-remove'></i></a>
                           <a href='<?php echo ROOT . "imagenNoticia/eliminar/" . $imagenNoticia->getId(); ?>' 
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


<!-- Modal -->
<div id="ModalImagenPop" class="modal fade" role="dialog" aria-labelledby="ImagenPop" aria-hidden="true" style="width: 100%;">
    <div class="modal-body">
        <img src="#" class="center-block" style="max-width:80%; height: auto; max-height: 60%; "/>
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
    </div>
</div>