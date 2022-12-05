<div>
  <ul class="nav nav-tabs mt-3">
    <li class="nav-item">
      <button 
      wire:click="selectClientsTab" 
      class="nav-link {{$clientsTabEnabled ? 'active' : ''}}" 
      href="#">Клиенты</button>
    </li>
    <li class="nav-item">
      <button 
      wire:click="selectStaffTab" 
      class="nav-link {{$staffTabEnabled ? 'active' : ''}}" 
      href="#">Сотрудники</button>
    </li>      
  </ul>  

  @if ($clientsTabEnabled)
    <livewire:contacts.clients />
  @elseif ($staffTabEnabled)
    <livewire:contacts.staff />
  @endif
</div>
