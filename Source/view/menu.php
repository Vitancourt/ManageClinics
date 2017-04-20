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
                 <a class="navbar-brand" href="index.html">Manage Clinics</a>
             </div>
             <!-- Begin-Menu-topo -->
             <ul class="nav navbar-right top-nav">
              <!-- Begin-Mensagens -->
                 <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                     <ul class="dropdown-menu message-dropdown">
                         <li class="message-preview">
                             <a href="#">
                                 <div class="media">
                                     <span class="pull-left">
                                         <img class="media-object" src="http://placehold.it/50x50" alt="">
                                     </span>
                                     <div class="media-body">
                                         <h5 class="media-heading"><strong>Nome do usuário</strong>
                                         </h5>
                                         <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                         <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                     </div>
                                 </div>
                             </a>
                         </li>
                         <li class="message-preview">
                             <a href="#">
                                 <div class="media">
                                     <span class="pull-left">
                                         <img class="media-object" src="http://placehold.it/50x50" alt="">
                                     </span>
                                     <div class="media-body">
                                         <h5 class="media-heading"><strong>John Smith</strong>
                                         </h5>
                                         <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                         <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                     </div>
                                 </div>
                             </a>
                         </li>
                         <li class="message-preview">
                             <a href="#">
                                 <div class="media">
                                     <span class="pull-left">
                                         <img class="media-object" src="http://placehold.it/50x50" alt="">
                                     </span>
                                     <div class="media-body">
                                         <h5 class="media-heading"><strong>John Smith</strong>
                                         </h5>
                                         <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                         <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                     </div>
                                 </div>
                             </a>
                         </li>
                         <li class="message-footer">
                             <a href="#">Read All New Messages</a>
                         </li>
                     </ul>
                 </li>
                 <!-- End-Mensagens -->
                 <!-- Begin-Alertas -->
                 <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                     <ul class="dropdown-menu alert-dropdown">
                         <li>
                             <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                         </li>
                         <li>
                             <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                         </li>
                         <li>
                             <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                         </li>
                         <li>
                             <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                         </li>
                         <li>
                             <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                         </li>
                         <li>
                             <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                         </li>
                         <li class="divider"></li>
                         <li>
                             <a href="#">View All</a>
                         </li>
                     </ul>
                 </li>
                 <!-- End-Alertas -->
                 <!-- Begin-Perfil -->
                 <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li>
                             <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                         </li>
                         <li>
                             <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                         </li>
                         <li>
                             <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                         </li>
                         <li class="divider"></li>
                         <li>
                             <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                         </li>
                     </ul>
                 </li>
                 <!-- End-Perfil -->
             </ul>
            <!-- Begin-MenuLateralResponsivo -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="homepage.html"><i class="fa fa-fw fa-dashboard"></i> Início</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#agenda"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><i class="fa fa-fw"></i> Agenda <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="agenda" class="collapse">
                            <li>
                                <a href="#">Ver agenda</a>
                            </li>
                            <li>
                                <a href="#">Adicionar agendamento</a>
                            </li>
                            <li>
                                <a href="#">Procurar agendamento</a>
                            </li>
                            <li>
                                <a href="#">Gerar relatório</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pacientes"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><i class="fa fa-fw"></i> Pacientes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pacientes" class="collapse">
                            <li>
                                <a href="adicionarPaciente.html">Adicionar paciente</a>
                            </li>
                            <li>
                                <a href="procurarPaciente.html">Procurar paciente</a>
                            </li>
                            <li>
                                <a href="#">Gerar relatório</a>
                            </li>
                        </ul>
                    </li>  
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#contas"><span class="glyphicon glyphicon-export" aria-hidden="true"></span><i class="fa fa-fw"></i> Contas a pagar <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="contas" class="collapse">
                            <li>
                                <a href="#">Adicionar conta</a>
                            </li>
                            <li>
                                <a href="#">Procurar conta</a>
                            </li>
                            <li>
                                <a href="#">Gerar relatório</a>
                            </li>
                        </ul>
                    </li>  
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#administrativa"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><i class="fa fa-fw"></i> Área administrativa <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="administrativa" class="collapse">
                            <li>
                                <a href="#">Fluxo de caixa</a>
                            </li>
                            <li>
                                <a href="#">Adicionar usuário</a>
                            </li>
                            <li>
                                <a href="#">Procurar usuário</a>
                            </li>
                        </ul>
                    </li> 
                
                 </ul>
             </div>
             <!-- End-MenuLateralResponsivo -->
         </nav>   } 
