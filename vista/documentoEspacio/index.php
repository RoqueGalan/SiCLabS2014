<h2>Index</h2>

<p>
    <a href="<?php echo ROOT . 'documentoEspacio/nuevo/' . $this->espacio; ?>" class="btn btn-link">Nuevo Documento</a>
</p>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Documento</th>
            <th>TipoDocumento</th>
            <th>Espacio</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($this->listaDocumentos as $key => $documento): ?>
            <tr>
                <td>
                    <a href="#" class="documentoPop" data-img-url="<?php echo ROOT . $documento->getRuta() . $documento->getDocumento(); ?>">
                        <?php echo $documento->getDocumento(); ?>
                    </a>
                </td>
                <td><?php echo $documento->getTipoDocumento()->getNombre(); ?></td>
                <td><?php echo $documento->getEspacio()->getNombre(); ?></td>
                <td>
                    <div class="btn-group btn-group-sm ">
                        <a href="<?php echo ROOT . 'documentoEspacio/editar/' . $documento->getId(); ?>" class="btn btn-default"><i class="fa fa-lg fa-edit"></i></a> 
                        <a href="<?php echo ROOT . 'documentoEspacio/mostrar/' . $documento->getId(); ?>"class="btn btn-primary"><i class="fa fa-lg fa-eye"></i></a>
                        <a href="javascript:;" class="btn btn-danger"
                           data-title="<div class='text-center text-danger'><b>¿Eliminar?</b></div>"
                           data-toggle="popover"
                           data-content="
                           <div class='text-center'>
                           <div class='btn-group btn-group-sm'>
                           <a class='btn btn-default' data-dismiss='popover' aria-hidden='true'><i class='fa fa-lg fa-remove'></i></a>
                           <a href='<?php echo ROOT . "documentoEspacio/eliminar/" . $documento->getId(); ?>' 
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

<!-- Modal Documento Pop -->
<div id="ModalDocumentoPop" class="modal fade" role="dialog" aria-labelledby="DocumentoPop" aria-hidden="true" style="width: 100%;">
    <div class="modal-body">
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
        <iframe scrolling="auto" class="center-block" src="#" frameborder="0" height="700" width="900"></iframe>	
        <button type="button" class="btn btn-danger center-block" data-dismiss="modal" aria-hidden="true">Cerrar [×]</button>
    </div>
</div>