<h2>Index</h2>
<h3><?php echo $this->espacio->getNombre(); ?></h3>

<p>
    <a href="<?php echo ROOT . 'equipo/nuevo/'. $this->espacio->getId(); ?>" class="btn btn-link">Nuevo Equipo</a>
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
            <th>Doc</th>
            <th>Oculto</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaEquipo as $key => $equipo): ?>
            <tr>
                <td><?php echo $equipo->getNombre(); ?></td>
                <td><?php echo $equipo->getMarca(); ?></td>
                <td><?php echo $equipo->getModelo(); ?></td>
                <td><?php echo $equipo->getNoSerie(); ?></td>
                <td><?php echo $equipo->getCondicion(); ?></td>
                <td><?php echo $equipo->getCaracteristicas(); ?></td>
                <td><?php echo $equipo->getCantidadTotal(); ?></td>
                <td><?php echo $equipo->getCantidadDisponible(); ?></td>
                <td><?php echo $equipo->getCodigoNacion(); ?></td>
                <td><?php echo $equipo->getCodigoUaem(); ?></td>
                <td>
                    <a href="#" class="imagenPop" data-img-url="<?php echo ROOT . $equipo->getRutaImg() . $equipo->getImagen(); ?>">
                        <img src="<?php echo ROOT . $equipo->getRutaImg() . '/mini/mini_' . $equipo->getImagen(); ?>" class="img-thumbnail" />
                    </a>
                </td>
                <td>
                    <a href="#" class="documentoPop" data-img-url="<?php echo ROOT . $equipo->getRutaDoc() . $equipo->getDocumento(); ?>">
                        <?php echo $equipo->getDocumento(); ?>
                    </a>
                </td>
                <td><?php echo $equipo->getOculto(); ?></td>
                
                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'equipo/editar/' . $equipo->getId(); ?>" class="btn btn-default"><i class="fa fa-lg fa-edit"></i></a> 
                        <a href="<?php echo ROOT . 'equipo/mostrar/' . $equipo->getId(); ?>"class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='fa fa-lg fa-remove'></i></a>
                           <a href='<?php echo ROOT . "equipo/eliminar/" . $equipo->getId(); ?>' 
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

<!-- Modal Documento Pop -->
<div id="ModalDocumentoPop" class="modal fade" role="dialog" aria-labelledby="DocumentoPop" aria-hidden="true" style="width: 100%;">
    <div class="modal-body">
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
        <iframe scrolling="auto" class="center-block" src="#" frameborder="0" height="700" width="900"></iframe>	
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
    </div>
</div>