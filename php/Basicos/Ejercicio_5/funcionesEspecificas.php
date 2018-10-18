<?php

function ponermenu($negocio)
{
    ?>


    <div class="menu">

        <form action="inicio.php" method="post">
            <input type="hidden" name="negocioencadena" value="<?= array_a_cadenaurl($negocio) ?>">
            <input type="submit" value="Inicio">
        </form>

        <form action="totalproducto.php" method="post">
            <input type="hidden" name="negocioencadena" value="<?= array_a_cadenaurl($negocio) ?>">
            <input type="submit" value="Ver total producto">
        </form>

        <form action="totalvendedor.php" method="post">
            <input type="hidden" name="negocioencadena" value="<?= array_a_cadenaurl($negocio) ?>">
            <input type="submit" value="Ver total vendedor">
        </form>

        <form action="modificarventas.php" method="post">
            <input type="hidden" name="negocioencadena" value="<?= array_a_cadenaurl($negocio) ?>">
            <input type="submit" value="Modificar ventas">
        </form>

        <form action="veringresostotales.php" method="post">
            <input type="hidden" name="negocioencadena" value="<?= array_a_cadenaurl($negocio) ?>">
            <input type="submit" value="Ver Ingresos totales">
        </form>


    </div>

    <?php
}