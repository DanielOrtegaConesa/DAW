<?php


spl_autoload_register('classAutoLoader');

function classAutoLoader($className){
    $dirPaths = [];
    $dirPaths[] = './';

    $dirPaths[] = 'modelo/clases/';
    $dirPaths[] = '../modelo/clases/';
    $dirPaths[] = '../modelo/clases/';
    $dirPaths[] = '../../modelo/clases/';
    $dirPaths[] = '../../../modelo/clases/';
    $dirPaths[] = '../../../../modelo/clases/';
    $dirPaths[] = '../../../../../modelo/clases/';
    $dirPaths[] = '../../../../../../modelo/clases/';
    $dirPaths[] = '../../../../../../../modelo/clases/';


    foreach($dirPaths as $path){
        $classPath = $path . $className . '.php';
        if (file_exists($classPath) && is_file($classPath)) {
            include_once $classPath;
            //echo $classPath;
        }
    }

}