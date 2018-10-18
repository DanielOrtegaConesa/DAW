<nav class="navbar navbar-expand-lg fixed-top navbar-light navbar-small">
    <div class="container-fluid">
        <a class="navbar-brand d-flex py-0 mr-0" href="inicio.php">
            <img class="logo" src="img/logo.png"/>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span style="color: #b9b4bd">Menú </span><i class="fa fa-bars" aria-hidden="true"></i>
        </button>


        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active align-middle">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Alta de datos
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="inicio.php?page=a/apreciosum">Preciosum</a>
                            <a class="dropdown-item" href="inicio.php?page=a/avendedor">Vendedor</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item active align-middle">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Busqueda/Borrado/Edicion
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="inicio.php?page=b/bpreciosum">Preciosum</a>
                            <a class="dropdown-item" href="inicio.php?page=b/bvendedor">Vendedor</a>
                            <a class="dropdown-item" href="inicio.php?page=b/bpieza">Pieza</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>