<?php
require 'clases/conexion.php';
session_start();

$sql="select sp_det_receta(".$_REQUEST['accion'].",".$_REQUEST['vrec_cod']."
,split_part('".$_REQUEST['vart_cod']."','_',1)::integer,"
        .(!empty($_REQUEST['vcantidad'])?$_REQUEST['vcantidad']:"0").") as resul";

$resultado= consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:receta_det.php?vrec_cod=".$_REQUEST['vrec_cod']);
}else{
    $_SESSION['mensaje']="Error al procesar \n".$sql;
    header("location:receta_det.php?vrec_cod=".$_REQUEST['vrec_cod']);   
}