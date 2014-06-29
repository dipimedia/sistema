<!DOCTYPE html>
<html ng-app="admin">
    <head>
        <meta charset="UTF-8">
        <title>DASEDA | Administrador</title>
        
        
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?= base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?= base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?= base_url(); ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?= base_url(); ?>css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?= base_url(); ?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?= base_url(); ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?= base_url(); ?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?= base_url(); ?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?= base_url(); ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Animation -->
        <link href="<?= base_url(); ?>css/animate.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>css/animacion.css" rel="stylesheet" type="text/css" />
        <!-- estilo de la app -->
        <link href="<?= base_url(); ?>css/style.css" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body ng-cloak>
        
        <div ng-show="muestra">
            <nav class="navbar  navbar-default" role="navigation">
                
                <div class="navbar-left">
                    <ul class="nav navbar-nav">
                        <li class="empresa text-center" >
                            <img src="<?= base_url(); ?>img/daseda.png" alt="">
                        </li>
                    </ul>
                </div>

                <ul class="push nav navbar-nav">
                    <li><a href="" id="trigger" class="toggle-push-left fa fa-align-justify"></a></li>
                </ul>

                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="perfil mail">
                            <a href="">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                        <li class="perfil notifi">
                            <a href="">
                                <i class="fa fa-bell"></i>
                            </a>
                        </li>
                        <li class="perfil sesion">
                            <a href="#/logout">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        

        <section class="contenido">
            
            <!-- menu izquierdo -->
            <div ng-show="muestra"  id="navega" class="navegacion">
                <div class="user-menu">
                    <img src="<?= base_url(); ?>img/avatar.png" alt="" class="avatar">
                    <div class="user-info">
                        <div class="welcome">{{usuario}}</div>
                        <div class="username"><i class="fa fa-circle text-success"></i> Conectado</div>
                    </div>
                </div>
                <ul class="cbp-vimenu">
                    <li class="add"><a href="#/home"><i class="icono fa fa-home"></i>Inicio</a></li>
                    <li class="add"><a href="#/cliente"><i class="icono fa fa-group"></i>Clientes</a></li>
                    <li class="add"><a href="#/provedor"><i class="icono fa fa-desktop"></i>Provedores</a></li>
                    <li class="add"><a href="#/producto"><i class="icono fa fa-barcode"></i>Productos</a></li>
                    <li class="add"><a href="#/venta"><i class="icono fa fa-money"></i>Ventas</a></li>
                    <li class="add"><a href="#/pedido"><i class="icono fa fa-thumb-tack"></i>Pedidos</a></li>
                    <li class="add"><a href="#/inventario"><i class="icono fa fa-truck"></i>Inventario</a></li>
                    <li class="add"><a href="#/reportes"><i class="icono fa fa-bar-chart-o"></i>Reportes</a></li>
                    <li class="add"><a href="#/notas"><i class="icono fa fa-columns"></i>Notas</a></li>
                    <li class="add"><a href="#/facturacion"><i class="icono fa fa-qrcode"></i>Facturación</a></li>
                    <li class="add"><a href="#/usuario"><i class="icono fa fa-user"></i>Usuarios</a></li>
                </ul>
            </div>
            
            <!-- aplicacion o las views -->
            <div ng-class="marca">
                    <div ng-view></div>
            </div>

        </section>
        
        <!-- jQuery 2.0.2 -->
        <script src="<?= base_url(); ?>js/jquery-2.1.1.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?= base_url(); ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?= base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Archivos de la App -->
        <script src="<?= base_url(); ?>modules/angular-file-upload-shim.min.js" ></script> 
        <script src="<?= base_url(); ?>app/angular.min.js"></script>
        <script src="<?= base_url(); ?>modules/angular-route.js" ></script>
        <script src="<?= base_url(); ?>modules/cookies.js" ></script>
        <script src="<?= base_url(); ?>modules/angular-animate.min.js" ></script>
        <script src="<?= base_url(); ?>modules/angular-file-upload.min.js" ></script> 
        <script src="<?= base_url(); ?>modules/angular-resource.min.js"></script>
        <script src="<?= base_url(); ?>modules/angular-idle.min.js"></script>
        <script src="<?= base_url(); ?>modules/angular-round-progress-directive.js"></script>
        <script src="<?= base_url(); ?>app/app.js"></script>
        <script src="<?= base_url(); ?>app/controller.js"></script>

        <!-- Morris.js charts -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?= base_url(); ?>js/plugins/morris/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="<?= base_url(); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?= base_url(); ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= base_url(); ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- fullCalendar -->
        <script src="<?= base_url(); ?>js/plugins/fullcalendar/fullcalendar.min.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= base_url(); ?>js/plugins/jqueryKnob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="<?= base_url(); ?>js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= base_url(); ?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- iCheck -->
        <script src="<?= base_url(); ?>js/plugins/iCheck/icheck.min.js"></script>
        <!-- InputMask -->
        <script src="<?= base_url(); ?>js/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?= base_url(); ?>js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <script src="<?= base_url(); ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?= base_url(); ?>js/plugins/datatables/jquery.dataTables.js"></script>
        <script src="<?= base_url(); ?>js/plugins/datatables/dataTables.bootstrap.js"></script>
        <!-- classiejs -->
        <script src="<?= base_url(); ?>js/classie.js"></script>
        <!-- cambiar background -->
        <script src="<?= base_url(); ?>js/jquery.backstretch.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url(); ?>js/AdminLTE/app.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!-- <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script> -->
        
         

    </body>
</html>