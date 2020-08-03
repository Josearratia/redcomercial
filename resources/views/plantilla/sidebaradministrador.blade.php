<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-building"></i>Empresas Registradas</a>
                    </li>
                    
                    <li  @click="menu=1" class="nav-item">
                        <a class="nav-link active" href="#"> <i class="fab fa-expeditedssl"></i> Usuarios Registrados</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-users"></i>Tipos de Usuarios</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-shopping-bag"></i> Clientes</a>
                            </li>
                            <li  @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-user-tie"></i> Vendedores</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-store"></i>Stores</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-concierge-bell"></i> Servicios</a>
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-box"></i>Articulos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-warehouse"></i>Almacén</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-concierge-bell"></i> Servicios</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-box"></i> Articulos</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-tag"></i>Categorias</a>
                            </li>
                        </ul>
                    </li>
               
                    <!--<li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                        <ul class="nav-dropdown-items">
                      
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                            </li>
                        </ul>
                    </li>-->
            
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>