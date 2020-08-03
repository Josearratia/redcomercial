<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=16" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fab fa-expeditedssl"></i>Cuenta</a>
                    </li>

                    <li @click="menu=17" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-cog"></i> Perfil</a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-folder-plus"></i>Adquirido</a>
                      <ul class="nav-dropdown-items">
                        <li @click="menu=19" class="nav-item">
                            <a class="nav-link active" href="#"><i class="fas fa-box"></i>Productos</a>
                        </li>

                            
                        <li @click="menu=20" class="nav-item">
                            <a class="nav-link active" href="#"><i class="fas fa-concierge-bell"></i>Servicios</a>
                        </li>
                       </ul>
                    </li>
         

                    <li @click="menu=21" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-shopping-cart"></i> Carrito</a>
                    </li>

                    <li @click="menu=22" class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-search-location"></i> Buscar </a>
                    </li>
                   
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>