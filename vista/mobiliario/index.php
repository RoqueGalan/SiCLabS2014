<h2>Index</h2>
<h3><?php echo $this->espacio->getNombre(); ?></h3>

<p>
    <a href="<?php echo ROOT . 'mobiliario/nuevo/'. $this->espacio->getId(); ?>" class="btn btn-link">Nuevo Mobiliario</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>NoSerie</th>
            <th>Condición</th>
            <th>Caracteristicas</th>
            <th>Total</th>
            <th>Disponible</th>
            <th>Cod.Nación</th>
            <th>Cod.Uaem</th>
            <th>Imagen</th>
            <th>Oculto</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaMobiliario as $key => $mobiliario): ?>
            <tr>
                <td><?php echo $mobiliario->getNombre(); ?></td>
                <td><?php echo $mobiliario->getMarca(); ?></td>
                <td><?php echo $mobiliario->getModelo(); ?></td>
                <td><?php echo $mobiliario->getNoSerie(); ?></td>
                <td><?php echo $mobiliario->getCondicion(); ?></td>
                <td><?php echo $mobiliario->getCaracteristicas(); ?></td>
                <td><?php echo $mobiliario->getCantidadTotal(); ?></td>
                <td><?php echo $mobiliario->getCantidadDisponible(); ?></td>
                <td><?php echo $mobiliario->getCodigoNacion(); ?></td>
                <td><?php echo $mobiliario->getCodigoUaem(); ?></td>
                <td>
                    <a href="#" class="imagenPop" data-img-url="<?php echo ROOT . $mobiliario->getRutaImg() . $mobiliario->getImagen(); ?>">
                        <img src="<?php echo ROOT . $mobiliario->getRutaImg() . '/mini/mini_' . $mobiliario->getImagen(); ?>" class="img-thumbnail" />
                    </a>
                </td>
                <td><?php echo $mobiliario->getOculto(); ?></td>
                
                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'mobiliario/editar/' . $mobiliario->getId(); ?>" class="btn btn-default"><i class="fa fa-lg fa-edit"></i></a> 
                        <a href="<?php echo ROOT . 'mobiliario/mostrar/' . $mobiliario->getId(); ?>"class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='fa fa-lg fa-remove'></i></a>
                           <a href='<?php echo ROOT . "mobiliario/eliminar/" . $mobiliario->getId(); ?>' 
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

<!-- Modal Imagen Pop -->
<div id="ModalImagenPop" class="modal fade" role="dialog" aria-labelledby="ImagenPop" aria-hidden="true" style="width: 100%;">
    <div class="modal-body">
        <img src="#" class="center-block" style="max-width:80%; height: auto; max-height: 60%; "/>
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
    </div>
</div>