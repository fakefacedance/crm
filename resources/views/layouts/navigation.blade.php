<ul class="nav flex-column mt-3 ms-2" >
  <li class="nav-item">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <a class="nav-link text-white" href="#">
        <i class="bi bi-person"></i> {{ auth()->user()->full_name }}
      </a>
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
      <a class="nav-link text-white" href="{{ route('tasks.index') }}">
        <i class="bi bi-calendar-check"></i> Задачи
      </a>
      <a href="{{ route('tasks.create') }}" class="badge fs-5 link-light">
        <i class="bi bi-plus-circle"></i>
      </a>
    </div>
  </li>
  <li class="nav-item">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <a class="nav-link text-white" href="{{ route('deals.index') }}">
        <i class="bi bi-currency-dollar"></i> Сделки
      </a>
      <a href="{{ route('deals.create') }}" class="badge fs-5 link-light">
        <i class="bi bi-plus-circle"></i>
      </a>
    </div>    
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('contacts') }}">
      <i class="bi bi-people"></i> Контакты
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('analytics.index') }}">
      <i class="bi bi-bar-chart"></i> Аналитика
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('settings') }}">
      <i class="bi bi-gear"></i> Настройки
    </a>
  </li>
  <li class="nav-item mt-3">
    <a class="nav-link text-white" href="{{ route('incoming_leads.index') }}">
      <i class="bi bi-chat-left-text"></i> Входящие лиды
    </a>
  </li>
</ul>