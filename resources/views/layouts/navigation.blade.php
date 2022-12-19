<ul class="nav flex-column mt-3 ms-2" style="font-size: 1.1rem;">
  <li class="nav-item">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <a class="nav-link text-white" href="#">{{ auth()->user()->full_name }}</a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="badge border-0 fs-5 bg-transparent">
          <i class="bi bi-box-arrow-right"></i>
        </button>
      </form>
    </div>    
  </li>
  <li class="nav-item">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <a class="nav-link text-white" href="{{ route('tasks.index') }}">Задачи</a>
      <a href="{{ route('tasks.create') }}" class="badge fs-5 link-light">
        <i class="bi bi-plus-circle"></i>
      </a>
    </div>
  </li>
  <li class="nav-item">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <a class="nav-link text-white" href="{{ route('deals.index') }}">Сделки</a>
      <a href="{{ route('deals.create') }}" class="badge fs-5 link-light">
        <i class="bi bi-plus-circle"></i>
      </a>
    </div>    
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('contacts') }}">Контакты</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('analytics.index') }}">Аналитика</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('settings') }}">Настройки</a>
  </li>
</ul>