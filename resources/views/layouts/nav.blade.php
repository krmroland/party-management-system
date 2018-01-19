<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand text-primary" href="/">
      Party Simplifier
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('budgets.index') }}">Budget</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pledges.index') }}">Pledges</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('providers.index') }}">Providers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('expenditures.index') }}">Expenditures</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('cards.index') }}">Cards</a>
      </li>
    </ul>
  </div>
</nav>