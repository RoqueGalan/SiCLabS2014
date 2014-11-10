<h2>Detalles</h2>

<div>
    <h4>Curso</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->curso->getId(); ?>
        </dd>

        <dt>
            Unidad de Aprendizaje
        </dt>
        <dd>
            <?php echo $this->curso->getUda()->getNombre(); ?>
        </dd>
        
        <dt>
            Grupo
        </dt>
        <dd>
            <?php echo $this->curso->getGrupo()->getNombre(); ?>
        </dd>
        
        <dt>
           Ciclo
        </dt>
        <dd>
            <?php echo $this->curso->getCiclo()->getNombre(); ?>
        </dd>
        
        <dt>
           Descripción
        </dt>
        <dd>
            <?php echo $this->curso->getDescripcion(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'curso/editar/' . $this->curso->getId(); ?>" class="btn btn-link">Editar</a> |
    
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

