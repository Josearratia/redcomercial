<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li @click="menu=10" class="nav-item">
        <a class="nav-link active" href="#"><i class="fab fa-expeditedssl"></i>Cuenta</a>
      </li>

      <li @click="menu=15" class="nav-item">
        <a class="nav-link active" href="#"><i class="fas fa-cog"></i>Perfil</a>
      </li>

      <li @click="menu=11" class="nav-item">
        <a class="nav-link active" href="#"><i class="fas fa-building"></i>Empresa</a>
      </li>


      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-store"></i>Store</a>
        <ul class="nav-dropdown-items">
          <li @click="menu=12" class="nav-item">
            <a class="nav-link active" href="#"><i class="fas fa-box"></i>Productos</a>
          </li>


          <li @click="menu=13" class="nav-item">
            <a class="nav-link active" href="#"><i class="fas fa-concierge-bell"></i>Servicios</a>
          </li>
        </ul>
      </li>





      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="fas fa-cash-register"></i>Ventas</a>
        <ul class="nav-dropdown-items">
          <li @click="menu=14" class="nav-item">
            <a class="nav-link active" href="#"><i class="fas fa-money-bill-alt"></i>Productos Vendidos</a>
          </li>


          <li @click="menu=18" class="nav-item">
            <a class="nav-link active" href="#"><i class="far fa-money-bill-alt"></i>Servicios Vendidos</a>
          </li>
        </ul>
      </li>


    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>