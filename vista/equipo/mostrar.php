<h2>Detalles</h2>

<div>
    <h4>Equipo: <?php echo $this->equipo->getEspacio()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
        Id
        </dt>
        <dd>
            <?php echo $this->equipo->getId(); ?>
        </dd>

        <dt>
        Nombre
        </dt>
        <dd>
            <?php echo $this->equipo->getNombre(); ?>
        </dd>

        <dt>
        Marca
        </dt>
        <dd>
            <?php echo $this->equipo->getMarca(); ?>
        </dd>

        <dt>
        Modelo
        </dt>
        <dd>
            <?php echo $this->equipo->getModelo(); ?>
        </dd>

        <dt>
        No. Serie
        </dt>
        <dd>
            <?php echo $this->equipo->getNoSerie(); ?>
        </dd>

        <dt>
        Condición
        </dt>
        <dd>
            <?php echo $this->equipo->getCondicion(); ?>
        </dd>

        <dt>
        Caracteristicas
        </dt>
        <dd>
            <?php echo $this->equipo->getCaracteristicas(); ?>
        </dd>

        <dt>
        Cantidad Total
        </dt>
        <dd>
            <?php echo $this->equipo->getCantidadTotal(); ?>
        </dd>

        <dt>
        Cantidad Disponible
        </dt>
        <dd>
            <?php echo $this->equipo->getCantidadDisponible(); ?>
        </dd>

        <dt>
        Código Nación
        </dt>
        <dd>
            <?php echo $this->equipo->getCodigoNacion(); ?>
        </dd>

        <dt>
        Código UAEM
        </dt>
        <dd>
            <?php echo $this->equipo->getCodigoUaem(); ?>
        </dd>

        <dt>
        Imagen
        </dt>
        <dd>
            <a href="#" class="imagenPop" data-img-url="<?php echo ROOT . $this->equipo->getRutaImg() . $this->equipo->getImagen(); ?>">
                <img src="<?php echo ROOT . $this->equipo->getRutaImg() . '/mini/mini_' . $this->equipo->getImagen(); ?>" class="img-thumbnail" />
            </a>
        </dd>

        <dt>
        Documento
        </dt>
        <dd>
            <a href="#" class="documentoPop" data-img-url="<?php echo ROOT . $this->equipo->getRutaDoc() . $this->equipo->getDocumento(); ?>">
                <?php echo $this->equipo->getDocumento(); ?>
            </a>
        </dd>

        <dt>
        Visibilidad
        </dt>
        <dd>
            <?php echo $this->equipo->getOculto(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'equipo/editar/' . $this->equipo->getId(); ?>" class="btn btn-link">Editar</a>
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