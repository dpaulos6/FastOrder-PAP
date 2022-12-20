<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="dashboard.php">
      <i class="ni fas fa-desktop text-default"></i>
      <span class="nav-link-text">Painel Principal</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pedidos.php">
      <i class="ni fas fa-shopping-basket text-default"></i>
      <span class="nav-link-text">Pedidos</span>
      <!-- <i class="fas fa-exclamation text-orange" style="margin-left: 1rem;"></i> -->
    </a>
  </li>
  <?php if($_SESSION['profile'] == "Administrador") { ?>
  <li class="nav-item">
    <a class="nav-link" href="produtos.php">
      <i class="fas fa-tag text-default"></i>
      <span class="nav-link-text">Produtos</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="categorias.php">
      <i class="ni fas fa-list-ul text-default"></i>
      <span class="nav-link-text">Categorias</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="utilizadores.php">
      <i class="ni fas fa-user text-default"></i>
      <span class="nav-link-text">Utilizadores</span>
    </a>
  </li>
  <?php } ?>
</ul>