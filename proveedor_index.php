<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/lp3/favicon.ico">
        <title>LP3</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php 
        session_start();/*Reanudar sesion*/
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                     <i class="fa fa-users"></i>
                                     <h3 class="box-title ">Proveedor</h3>
                                     <div class="box-tools">
                                         <a href="proveedor_print.php" class="btn btn-default btn-sm" data-title ="Imprimir" rel="tooltip" data-placement="top" target="print">
                                            <i class="fa fa-print"></i>
                                        </a>
                                         <a href="proveedor_add.php" class="btn btn-primary btn-sm pull-right" data-title="Nuevo" rel="tooltip"
                                            data-placement="top">
                                            <i class="fa fa-plus"></i></a>
                                     </div>
                                     
                                </div>
                                <div class="box-body  no-padding">
                                         
                                           <div class="row"> 
                                               <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <?php if(!empty($_SESSION['mensaje'])){ ?>
                                                    <div class="alert alert-danger" role="alert" id="mensaje">
                                                        <span class="glyphicon glyphicon-exclamation-sign"></span>
                                                        <?php echo $_SESSION['mensaje'];
                                                    $_SESSION['mensaje']='';?>

                                                    </div>
                                                    <?php } ?>
                                                    <div class="row">   
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <form action="" method="POST" accept-charset="utf-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" 
                                                                   placeholder="Ingrese parametro de búsqueda" autofocus="">
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar..." rel="tooltip" 
                                                                        data-placement="top">
                                                                    <i class="fa fa-search"></i>
                                                                </button>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                                   <?php 
                                                   $proveedor = consultas::get_datos("select * from proveedor "
                                                       . "where (prv_ruc ||prv_razonsocial) ilike '%".(isset($_REQUEST['buscar'])? $_REQUEST['buscar']:'')."%' order by prv_cod");
                                                 if (!empty($proveedor)) { ?>
                                                   <div class="table-responsive">
                                                       <table class="table table-striped table-condensed table-hover">
                                                           <thead>
                                                               <tr>
                                                                   <th>RUC:</th>
                                                                   <th>Razon Social:</th>
                                                                   <th>Direccion:</th>
                                                                   <th>Telefono:</th>
                                                                   
                                                                   <th class="text-center">Acciones</th>
                                                                   
                                                               </tr>
                                                               
                                                           </thead>
                                                           <tbody>
                                                               <?php foreach ($proveedor as $pro) { ?>
                                                               
                                                               <tr>
                                                                   <td data-title="RUC"><?php echo $pro['prv_ruc'];?></td>
                                                                   <td data-title="Razon Social"><?php echo $pro['prv_razonsocial'];?></td>
                                                                   <td data-title="Direccion"><?php echo $pro['prv_direccion'];?></td>
                                                                   <td data-title="Telefono"><?php echo $pro['prv_telefono'];?></td>
                                                                  
                                                                   <td class="text-center">
                                                                       <a href="proveedor_edit.php?vprv_cod=<?php echo $pro['prv_cod'];?>" class="btn btn-warning btn-sm" data-title="Editar"
                                                                           rel="tooltip" data-placement="top" role="button">
                                                                           <i class="fa fa-edit"></i>
                                                                       </a>
                                                                       <a onclick="borrar(<?php echo "'".$pro['prv_cod']."_".$pro['prv_ruc']."_".$pro['prv_razonsocial']."_".$pro['prv_direccion']."_".$pro['prv_telefono']."'"?>)" class="btn btn-danger btn-sm" role="button" data-title="Borrar" 
                                                                       rel="tooltip" data-placement="top" data-toggle='modal' data-target='#borrar'>
                                                                        <span class="glyphicon glyphicon-trash"></span></a>
                                                                       
                                                                   </td>
                                                               </tr>
                                                           <?php } ?>
                                                           </tbody>
                                                       </table>
                                                       
                                                   </div>
                                                   
                                                           <?php }else {?>
                                                   <div class="alert alert-info flat">
                                                       <span class="glyphicon glyphicon-info-sign"></span>
                                                       No se Han Registrado Proveedores..!
                                                       
                                                   </div>
                                                           <?php } ?>
                                                   
                                               </div>
                                         </div>
                                         
                                     </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>

             
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->
                  <!-- MODAL PARA BORRAR-->
                  <div class="modal fade" id="borrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="fa fa-remove"></i></button>
                                      <h4 class="modal-title custom_align" id="Heading">Atención!!!</h4>
                              </div>
                               <div class="modal-body">
                                   <div class="alert alert-danger" id="confirmacion"></div>
                                  </div>
                                  <div class="modal-footer">
                                      <button data-dismiss="modal" class="btn btn-default"><i class="fa fa-remove"></i> NO</button>
                                      <a id="si" role='buttom' class="btn btn-primary">
                                          <span class="glyphicon glyphicon-ok-sign"> SI</span>
                                      </a>
                                  </div>
                          </div>
                      </div>                      
                  </div>
                  <!-- FIN MODAL PARA BORRAR--> 
            </div> 
        
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
        $("#mensaje").delay(4000).slideUp(200, function(){
        $(this).alert('close');
        });
            </script>
            <script>
            $('.modal').on('shown.bs.modal',function(){
               $(this).find('input:text:visible:first').focus(); 
            });
        </script> 
            
            <script> 
            function borrar(datos){
                var dat = datos.split("_");
                $('#si').attr('href','proveedor_control.php?vprv_cod='+dat[0]+'&vprv_ruc='+dat[1]+'&vprv_razonsocial='+dat[2]+'&vprv_direccion='+dat[3]+'&vprv_telefono='+dat[4]+'&accion=3');
                $('#confirmacion').html('<span class="glyphicon glyphicon-question-sign"></span> \n\
                Desea borrar el proveedor <i><strong>'+dat[2]+' del ruc '+dat[1]+'  </strong></i>?');
            }
            </script>
    </body>
</html>


