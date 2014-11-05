<h2>Detalles</h2>

<div>
    <h4>Equipo: <?php echo $this->mobiliario->getEspacio()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
        Id
        </dt>
        <dd>
            <?php echo $this->mobiliario->getId(); ?>
        </dd>

        <dt>
        Nombre
        </dt>
        <dd>
            <?php echo $this->mobiliario->getNombre(); ?>
        </dd>

        <dt>
        Marca
        </dt>
        <dd>
            <?php echo $this->mobiliario->getMarca(); ?>
        </dd>

        <dt>
        Modelo
        </dt>
        <dd>
            <?php echo $this->mobiliario->getModelo(); ?>
        </dd>

        <dt>
        No. Serie
        </dt>
        <dd>
            <?php echo $this->mobiliario->getNoSerie(); ?>
        </dd>

        <dt>
        Condición
        </dt>
        <dd>
            <?php echo $this->mobiliario->getCondicion(); ?>
        </dd>

        <dt>
        Caracteristicas
        </dt>
        <dd>
            <?php echo $this->mobiliario->getCaracteristicas(); ?>
        </dd>

        <dt>
        Cantidad Total
        </dt>
        <dd>
            <?php echo $this->mobiliario->getCantidadTotal(); ?>
        </dd>

        <dt>
        Cantidad Disponible
        </dt>
        <dd>
            <?php echo $this->mobiliario->getCantidadDisponible(); ?>
        </dd>

        <dt>
        Código Nación
        </dt>
        <dd>
            <?php echo $this->mobiliario->getCodigoNacion(); ?>
        </dd>

        <dt>
        Código UAEM
        </dt>
        <dd>
            <?php echo $this->mobiliario->getCodigoUaem(); ?>
        </dd>

        <dt>
        Imagen
        </dt>
        <dd>
            <a href="#" class="imagenPop" data-img-url="<?php echo ROOT . $this->mobiliario->getRutaImg() . $this->mobiliario->getImagen(); ?>">
                <img src="<?php echo ROOT . $this->mobiliario->getRutaImg() . '/mini/mini_' . $this->mobiliario->getImagen(); ?>" class="img-thumbnail" />
            </a>
        </dd>

        <dt>
        Visibilidad
        </dt>
        <dd>
            <?php echo $this->mobiliario->getOculto(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'mobiliario/editar/' . $this->mobiliario->getId(); ?>" class="btn btn-link">Editar</a>
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>


<!-- Modal Imagen Pop -->
<div id="ModalImagenPop" class="modal fade" role="dialog" aria-labelledby="ImagenPop" aria-hidden="true" style="width: 100%;">
    <div class="modal-body">
        <img src="#" class="center-block" style="max-width:80%; height: auto; max-height: 60%; "/>
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
    </div>
</div>