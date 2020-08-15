<nav class="navbar navbar-expand-lg navbar-dark rounded py-0 px-lg-0" style="background-color: #e52042">
    <span class="d-lg-none navbar-brand">Menu</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu_estabelecimento" aria-controls="menu_estabelecimento" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
    <div class="collapse navbar-collapse" id="menu_estabelecimento">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('estabelecimento_home', ['user' => Auth::user(), 'estabelecimento' => $estabelecimento]) }}">{{ $estabelecimento->nome_fantasia }} <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pedidos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cadastros
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('mesas_index', ['estabelecimento' => $estabelecimento]) }}"><i class="fas fa-chair"></i>&nbsp;&nbsp;Mesas</a>
            <a class="dropdown-item" href="{{ route('cardapios_index', ['estabelecimento' => $estabelecimento]) }}"><i class="fas fa-book-reader"></i>&nbsp;&nbsp;Cardápios</a>
            <a class="dropdown-item" href="{{ route('categorias_index', ['estabelecimento' => $estabelecimento]) }}"><i class="fas fa-list-ul"></i>&nbsp;&nbsp;Categorias</a>
            <a class="dropdown-item" href="{{ route('items_index', ['estabelecimento' => $estabelecimento]) }}"><i class="fas fa-hamburger"></i>&nbsp;&nbsp;Ítens de cardápio</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Dados do estabelecimento</a>
          </li>
      </ul>
      
    </div>
</nav>
