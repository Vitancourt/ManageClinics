<?php
    require_once("../controller/carregaDadosHome.php");
    $nomeUsuario = $_SESSION['nomeUsuario'];
?>
<body>

     <div id="wrapper">

         <!-- Navigation -->
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
             <!-- Brand and toggle get grouped for better mobile display -->
             <div class="navbar-header">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </button>
                 <a class="navbar-brand" href="#">Manage Clinics</a>
             </div>
             <!-- Begin-Menu-topo -->
             <ul class="nav navbar-right top-nav">
                 <!-- Begin-Perfil -->
                 <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nomeUsuario; ?><b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li>
                             <a href="#"><i class="fa fa-fw fa-user"></i> Sua conta</a>
                         </li>
                         <li>
                             <a href="../controller/logoff.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                         </li>
                     </ul>
                 </li>
                 <!-- End-Perfil -->
             </ul>
            <!-- Begin-MenuLateralResponsivo -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="homepage.php"><i class="fa fa-fw fa-dashboard"></i> Início</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pacientes"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><i class="fa fa-fw"></i> Pacientes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pacientes" class="collapse">
                            <li>
                                <a href="<?php echo $css; ?>adicionarPaciente.php">Adicionar paciente</a>
                            </li>
                            <li>
                                <a href="<?php echo $css; ?>listarPaciente.php">Procurar paciente</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#contas"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span><i class="fa fa-fw"></i> Caixa <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="contas" class="collapse">
                            <li>
                                <a href="<?php echo $css; ?>adicionarConta.php">Adicionar conta</a>
                            </li>
                            <li>
                                <a href="<?php echo $css; ?>listarConta.php">Procurar conta</a>
                            </li>
                            <li>
                                <a href="<?php echo $css; ?>fluxoCaixa.php">Fluxo de caixa</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#administrativa"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><i class="fa fa-fw"></i> Área administrativa <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="administrativa" class="collapse">
                            <li>
                                <a href="<?php echo $css; ?>adicionarUsuario.php">Adicionar usuário</a>
                            </li>
                            <li>
                                <a href="<?php echo $css; ?>listarUsuario.php">Procurar usuário</a>
                            </li>
                        </ul>
                    </li>

                 </ul>
             </div>
             <!-- End-MenuLateralResponsivo -->
         </nav>
