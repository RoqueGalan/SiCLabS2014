<h2>Detalles</h2>

<div>
    <h4>Software: <?php echo $this->software->getEspacio()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
        Id
        </dt>
        <dd>
            <?php echo $this->software->getId(); ?>
        </dd>

        <dt>
        Nombre
        </dt>
        <dd>
            <?php echo $this->software->getNombre(); ?>
        </dd>

        <dt>
        Descripción
        </dt>
        <dd>
            <?php echo $this->software->getDescripcion(); ?>
        </dd>

        <dt>
        Visibilidad
        </dt>
        <dd>
            <?php echo $this->software->getOculto(); ?>
        </dd>

    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'software/editar/' . $this->software->getId(); ?>" class="btn btn-link">Editar</a>
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