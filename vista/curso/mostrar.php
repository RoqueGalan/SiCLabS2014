<h2>Detalles</h2>

<div>
    <h4>Curso: <?php echo $this->curso->getEspacio()->getNombre(); ?></h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Id
        </dt>
        <dd>
            <?php echo $this->curso->getId(); ?>
        </dd>

        <dt>
            Asignatura
        </dt>
        <dd>
            <?php echo $this->curso->getAsignatura()->getNombre(); ?>
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
        
        <dt>
           Carrera
        </dt>
        <dd>
            <?php echo $this->curso->getCarrera()->getNombre(); ?>
        </dd>
    </dl>
</div>

<p>
    <a href="<?php echo ROOT . 'curso/editar/' . $this->curso->getId(); ?>" class="btn btn-link">Editar</a> |
    <a href="<?php echo ROOT . 'horarioCurso/index/' . $this->curso->getId(); ?>" class="btn btn-link">Ver Horario</a> |
    <a href="<?php echo ROOT . 'impartir/index/' . $this->curso->getId(); ?>" class="btn btn-link">Ver Impartir</a> |
    <a href="<?php echo ROOT . 'cursar/index/' . $this->curso->getId(); ?>" class="btn btn-link">Ver Cursar</a> |
    
    <input type="button" value="Regresar" onclick="history.back(-1)" class="btn btn-link"> 
</p>

