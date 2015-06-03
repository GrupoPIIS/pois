<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <link rel="stylesheet" href="<?php echo base_url();?>/estilos/css/estilo1.css">
    <link href="<?php echo base_url();?>/estilos/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
    <link href="<?php echo base_url();?>/estilos/css/freelancer.css" rel="stylesheet">
        <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>/estilos/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>/estilos/css/jquery.ui.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" >
    <script src="<?php echo base_url();?>/estilos/js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="<?php echo base_url();?>/estilos/js/jquery.combinedScroll.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        var centreGot = false;
        var activeMap=false;
        var usermarker;
        var circleactive = false;
        var circle;
        

        function datos_marker(lat, lng, marker)
        {
             var mi_marker = new google.maps.LatLng(lat, lng);
             map.panTo(mi_marker);
             google.maps.event.trigger(marker, 'click');
        }
    
        function hoverapp(element) {
            element.setAttribute('src', 'estilos/img/app2.png');
        }

        function unhoverapp(element) {
            element.setAttribute('src', 'estilos/img/app.png');
        } 

        function showVal(newVal){
            document.getElementById("km").innerHTML=newVal+" kms";
        }
        
        jQuery(document).ready(function(){
            $('#buscar').hide();            
            $('#categ').hide();
            $('#km').hide();
            $('#boton-buscar').hide();

            jQuery('#hideshow').on('click', function(event) {
        
                $('#buscar').toggle('show');

                if($('#hideshow').is(':checked') || $('#hideshow2').is(':checked') )
                    $('#boton-buscar').show(500);  
                else
                    $('#boton-buscar').hide(500);

                if($('#hideshow').is(':checked')){
                    $('#km').show(500);
                }else{
                     $('#km').hide(500);
                }
              
            });

            jQuery('#hideshow2').on('click', function(event) {                       
                $('#categ').toggle('show');
                if($('#hideshow').is(':checked') || $('#hideshow2').is(':checked') )
                    $('#boton-buscar').show(500);  
                else
                    $('#boton-buscar').hide(500);
              
             });

        });

        jQuery(document).ready(function($){
            
                $('.page-navigation').onePageNav(); 


                $(function(){
                    $('.page-navigation').data('size','big');
                });

                $(window).scroll(function(){
                    var $nav = $('.page-navigation');
                    if ($('body').scrollTop() > 0) {
                        if ($nav.data('size') == 'big') {
                            $nav.data('size','small').stop().animate({
                                padding:'0 0.2%'
                            }, 600);
                        }
                    } else {
                        if ($nav.data('size') == 'small') {
                            $nav.data('size','big').stop().animate({
                                padding:'1%'
                            }, 600);
                        }  
                    }
                });            

        }); 
        
        $(document).ready(function(){
            $('#categ').autocomplete({
                source:"<?php echo site_url('categorias_controller/search/?'); ?>"
            });
        });

    </script>
    <?=$map['js']?> 

</head>

<body id="page-top" class="index">

    <nav class="page-navigation">
            <a href="#" onclick="javascript:location.href='<?php echo base_url();?>'"><img src="estilos/img/centic.jpg"></a>

                <ul class="menu">
                    <li><a href="#header-principal">BUSCAR POIS</a></li>
                    <li><a href="#portfolio">PUNTOS M&Aacute;S VISITADOS</a></li>
                    <li><a href="#about">PREGUNTAS FRECUENTES</a></li>
                    <li><a href="#" onclick="javascript:location.href='<?php echo base_url();?>login_controller/contact'">CONTACTO</a></li>
                    <li><a href="#" id="acceso" onclick="javascript:location.href='login_controller'">ACCESO</a></li>
                </ul>           
    </nav>

    <!-- Header -->            
    <header id="header-principal">                
        <article id="header-tittle">
            <h1><font color="#ffffff">Busca a tus alrededores</font></h1>                    
            <!-- <hr class="star-light">-->  
            <span class="skills">Explora y conoce los lugares de interés que hay a tu alrededor a través de nuestra aplicación</span>          
        </article>  
        <article id="imgApp">
            <a href="https://play.google.com/store?hl=es_419" title="">
                <img src="estilos/img/app.png" width="150" title="Descargar Aplicacion" onmouseover="hoverapp(this);" onmouseout="unhoverapp(this);"/>
            </a>            
        </article>
       
        <div id="ubicacion">          
            <form action="<?php echo base_url();?>Mapa" method="post" >
                <input type="checkbox" id="hideshow" name="distancia" value="distancia" class="checkbox1">
                <span>Buscar por distancia</span> 
                <input type="checkbox" id="hideshow2" name="categoria"value="categoría" class="checkbox1">
                <span>Buscar por categor&iacute;a</span>                
                <div id="distancia">
                    <input id="buscar" type="range" name="sitio" min="0" max="100"  oninput="showVal(this.value)" onchange="showVal(this.value)">
                    <span id="km">kms</span>
                </div>
                <input id="categ" type="text" name="categ" placeholder="Introduzca categor&iacute;a, ejemplo: Restaurante">            
                <input id="latitud" type="hidden" name="lat">
                <input id="longitud" type="hidden" name="lng">
                <input id="dragged" type="hidden" name="dragged">
                <input id="boton-buscar" type="submit" value="Buscar" class="btn btn-success btn-lg">
            </form>                 
        </div>
    </header>
    <section id="section-mapa">
        <article id="mapa-principal">
            <?=$map['html']?>
        </article> 
        <aside id="lado">
                
                <article id="enlaces">
                    <h3>POIS CERCANOS</h3>                 
                    <ul>                            
                            <li class="posicion-actual" onclick="datos_marker(usermarker.position.lat(),usermarker.position.lng(),usermarker)">
                                Su Posici&oacute;n</li><?php
                            if($datos){
                                foreach($datos->result() as $marker_sidebar)
                                {
                                    ?><li class="posicion-poi" onclick="datos_marker(<?=$marker_sidebar->lat?>,<?=$marker_sidebar->lng?>,marker_<?=$marker_sidebar->id_poi?>)">
                                    <?=substr($marker_sidebar->nombre_poi,0,10)?></li><?php
                                }
                            }
                        ?>
                    </ul>
                </article>
            </aside>

    </section>    

    

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Puntos m&aacute;s visitados</h2>
                    <hr class="star-primary">
                </div>
            </div>

            <ul class="mas-visitados">
                <li>
                    <a href="<?php echo base_url();?>pois/pois_controller/getPoi/<?=$visitados->result()[0]->id_poi;?>">
                        <article class="mv-article golden">
                            <h3>1. <?=$visitados->result()[0]->nombre_poi;?></h3>                           
                        </article>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>pois/pois_controller/getPoi/<?=$visitados->result()[1]->id_poi;?>">
                        <article class="mv-article silver">
                            <h3>2. <?=$visitados->result()[1]->nombre_poi;?></h3>                           
                        </article>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>pois/pois_controller/getPoi/<?=$visitados->result()[2]->id_poi;?>">
                        <article class="mv-article bronze">
                            <h3>3. <?=$visitados->result()[2]->nombre_poi;?></h3>                       
                        </article>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>pois/pois_controller/getPoi/<?=$visitados->result()[3]->id_poi;?>">
                        <article class="mv-article">
                            <h3>4. <?=$visitados->result()[3]->nombre_poi;?></h3>                       
                        </article>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>pois/pois_controller/getPoi/<?=$visitados->result()[4]->id_poi;?>">
                        <article class="mv-article">
                            <h3>5. <?=$visitados->result()[4]->nombre_poi;?></h3>                            
                        </article>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>pois/pois_controller/getPoi/<?=$visitados->result()[5]->id_poi;?>">
                        <article class="mv-article">
                            <h3>6. <?=$visitados->result()[5]->nombre_poi;?></h3>                        
                        </article>
                    </a>
                </li>
            </ul>        
           
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Preguntas frecuentes</h2>
                     <hr class="star-secundary">
                </div>
            </div>
            <div class="row">
                <div class="faqs">
                    <p class="pregunta">¿C&oacute;mo puedo realizar una búsqueda?</p>
                    <p class="respuesta">
                        Para realizar un b&uacute;squeda, lo que hay que hacer es seccionar una de las opciones de búsqueda: distancia, categor&iacute;a o ambas.
                        Una vez seleccionado el criterio de b&uacute;squeda, hay que seleccionar la distancia moviendo la barra de kil&oacute;metros o insertar una categoía en el campo de texto.
                        Finalmente, seleccionamos el bot&oacute;n buscar y nos aparecer&aacute;n los puntos de inter&eacute;s disponibles.
                    </p>
                    <p class="pregunta">¿C&oacute;mo puedo hacer zoom en el mapa para interactuar manualmente?</p>
                    <p class="respuesta">
                        Para interactuar con el mapa y hacer zoom con el scroll del rat&oacute;n, hay que hacer click primero en el mapa y tras esto, ya podemos hacer scroll con normalidad.
                        Si queremos volver a bloquearlo, debemos de volver a hacer click.
                   </p>
                   <p class="pregunta">¿C&oacute;mo puedo crear un nuvo Punto de Inter&eacute;s?</p>
                   <p class="respuesta">
                        Para crear un nuevo POI, debemos de ser un usuario registrado. 
                        Si es así, lo primero que tenemos que hacer es acceder con nuestra cuenta de usuario y contraseña, y un vez en el menú principal, hacer click sobre el botón &quot;Crear Nuevo POI&quot;.
                        Ua vez hecho esto, debemos de rellenar los datos en las siguientes pasos que nos vaya indicando.
                   </p>
                   <p class="pregunta">¿C&oacute;mo puedo tener una cuenta de usuario?</p>
                   <p class="respuesta">
                        Para tener una cuenta de usuario, hay que contactar con el Administrador de la p&aacute;gina mediante el formulario de acceso, al que podemos llegar mediante la opción del men&uacute; superior &quot;CONTACTO&quot;.
                        Tendremos que rellenar dicho formulario y enviarlo con nuestra petici&oacute;n.
                        El administrador, nos contestar&aacute; con un e-mail.
                   </p>
                </div>                
            </div>
        </div>
    </section>
<!-- 
     
    
-->
     <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Localización</h3>
                        <p>Calle Condes de Barcelona, 5, 30007 Murcia
                        <br>968 96 44 00</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Redes sociales</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Sobre nosotros</h3>
                        <p>Para más información <a href="http://www.google.com">Google</a>.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Grupo 1 2015
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

   
    <!-- jQuery -->
    <script src="estilos/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="estilos/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="estilos/js/classie.js"></script>
    <script src="estilos/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="estilos/js/jqBootstrapValidation.js"></script>
     <!-- <script src="estilos/js/contact_me.js"></script>

    Custom Theme JavaScript -->
    <script src="estilos/js/freelancer.js"></script>
    <script src="estilos/js/jquery.ui.js" type="text/javascript"></script>
</body>

</html>
