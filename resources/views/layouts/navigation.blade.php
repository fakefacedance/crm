<ul class="nav flex-column mt-3 ms-2 fs-5">
  <li class="nav-item">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <a class="nav-link text-white" href="#">Профиль</a>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-light">Выйти</button>
      </form>
    </div>    
  </li>
  <li class="nav-item">
    <div class="d-flex flex-row align-items-center justify-content-between">
      <a class="nav-link text-white" href="{{ route('tasks.index') }}">Задачи</a>
      <a class="btn btn-sm btn-outline-light" href="{{ route('tasks.create') }}">Создать</a>
    </div>    
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="#">Сделки</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('contacts') }}">Контакты</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="#">Аналитика</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('settings') }}">Настройки</a>
  </li>
</ul>