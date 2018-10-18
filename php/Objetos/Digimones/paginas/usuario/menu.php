<?php
function ponermenu($usuario)
{
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="inicio_usuario.php?usuario=<?= $usuario ?>">Inicio</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="ver_digimon.php?usuario=<?= $usuario ?>">Ver digimon</a></li>
                    <li><a href="ver_mis_digimon.php?usuario=<?= $usuario ?>">Ver Mis Digimon</a></li>
                    <li><a href="ver_mi_equipo.php?usuario=<?= $usuario ?>">Mi Equipo</a></li>
                    <li><a href="jugar_partida.php?usuario=<?= $usuario ?>">Jugar Partida</a></li>
                    <li><a href="digievolucionar.php?usuario=<?= $usuario ?>">Digievolucionar</a></li>
                    <li><a href="organizar_equipo.php?usuario=<?= $usuario ?>">Organizar Equipo</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <?php
    //navbar-collapse collapse in
}