<?php include '../static/CSS/header.css'; ?>
<div id="header">
    <a id="inicio" href="inicio"><img id="logo" src="static/resources/logoHeader/logo.png"></a>
    <ul id="navBar">
        <li class="navBarItem"><a href="inicio"><button>Inicio</button></a></li>
        <li class="navBarItem"><a href="catalogo"><button>Catalogo</button></a></li>
             <!--<a href="soporte"><li class="navBarItem">Soporte</li></a>-->
    </ul>

    <div id="opcionesUser">
        <?php if(isset($this->logueado)){ ?>
            <div id="menuUsuario" onmouseover="desplegarById('conjuntoElementosUsuario')" onmouseout="desplegarById('conjuntoElementosUsuario')">
                <button id="nombreUsuario"><?=$this->usuNom?></button>
                <div id="conjuntoElementosUsuario">
                    <a class="elementoUsuario" href="perfil">Perfil</a>
                    <a class="elementoUsuario" href="biblioteca">Biblioteca</a>
                    <a class="elementoUsuario" href="wishlist">Lista de deseos</a>
                    <a class="elementoUsuario" href="carrito">Carrito</a>
                    <?php if(isset($this->prevUrl)){ ?>
                        <a class="elementoUsuario" href="logout?prevUrl=<?=urlencode($this->prevUrl)?>">Cerrar sesion</a>
                    <?php }else{ ?>
                        <a class="elementoUsuario" href="logout">Cerrar sesion</a>
                    <?php } ?>
                </div>
            </div>

            <script>
                desplegarById('conjuntoElementosUsuario');
            </script>

        <?php }else{ ?>
            <?php if(isset($this->prevUrl)){ ?>
                <a id="login" href="login?prevUrl=<?=urlencode($this->prevUrl)?>"><button>Iniciar sesion</button></a>
            <?php }else{ ?>
                <a id="login" href="login"><button>Iniciar sesion</button></a>
            <?php } ?>
        <?php } ?>
    </div>
</div>
    
