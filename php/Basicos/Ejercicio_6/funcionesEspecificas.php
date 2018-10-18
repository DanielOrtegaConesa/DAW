<?php
function ponermenu($empresa)
{
    ?>


    <div class="menu">

        <form action="inicio.php" method="post">
            <input type="hidden" name="empresaencadena" value="<?= array_a_cadenaurl($empresa) ?>">
            <input type="submit" value="Inicio">
        </form>

        <form action="altatrab.php" method="post">
            <input type="hidden" name="empresaencadena" value="<?= array_a_cadenaurl($empresa) ?>">
            <input type="submit" value="Alta">
        </form>

        <form action="bajatrab.php" method="post">
            <input type="hidden" name="empresaencadena" value="<?= array_a_cadenaurl($empresa) ?>">
            <input type="submit" value="Baja">
        </form>

        <form action="vertrab.php" method="post">
            <input type="hidden" name="empresaencadena" value="<?= array_a_cadenaurl($empresa) ?>">
            <input type="submit" value="ver trabajador">
        </form>
    </div>

    <?php

    function sueldobruto($horas)
    {
        $contadas=0;
        $sueldo=0;

        if ($contadas < $horas) {

            while ($contadas < 30 && $contadas < $horas) {
                $contadas++;
                $sueldo += 6;
            }

            while ($contadas <= 40 && $contadas < $horas) {
                $contadas++;
                $sueldo += 9;
            }

            while ($contadas <= 50 && $contadas < $horas) {
                $contadas++;
                $sueldo += 12;
            }

        }
return $sueldo;
    }
    function impuestos($horas){
        $bruto = sueldobruto($horas);
        $euroscontados=0;
        $impuestos=0;

        if ($euroscontados < $bruto) {

            while ($euroscontados < 180 && $euroscontados <= $bruto) {
                $euroscontados++;
                $impuestos += 0.1;
            }
            while ($euroscontados <= $bruto) {
                $euroscontados++;
                $impuestos += 0.15;
            }
        }
        return $impuestos;
    }
}
