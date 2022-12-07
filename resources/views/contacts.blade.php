<x-app-layout>
  <x-slot:title>Контакты</x-slot:title>
  <x-slot:brand>Контакты</x-slot:brand>    

  {{-- <livewire:contacts.index /> --}}
  <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="clients-tab" data-bs-toggle="tab" data-bs-target="#clients-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Клиенты</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff-tab-pane" type="button" role="tab" aria-controls="staff-tab-pane" aria-selected="false">Сотрудники</button>
    </li>    
  </ul>
  <div class="tab-content" id="myTabContent">
    
    <div class="tab-pane fade show active" id="clients-tab-pane" role="tabpanel" aria-labelledby="clients-tab" tabindex="0">
      @can('add client')
      <div class="mt-3">
        <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm">+ Добавить</a>
      </div>    
      @endcan
      <div class="row g-3 mt-1">
        @foreach ($clients as $client)
          <div class="col-4">
            <a href="{{ route('clients.show', $client->id) }}" class="p-3 border rounded nav-link">
              <div class="fw-semibold">
                {{ $client->full_name }}
              </div>          
              <div>
                {{ $client->phone_number }}
              </div>          
            </a>
          </div>
        @endforeach            
      </div>
      <div class="d-flex justify-content-start mt-3">
        {!! $clients->links() !!}
      </div>
    </div>

    <div class="tab-pane fade" id="staff-tab-pane" role="tabpanel" aria-labelledby="staff-tab" tabindex="0">
      @can('add employee')
        <div class="mt-3">
          <a href="{{ route('staff.create') }}" class="btn btn-primary btn-sm">+ Добавить</a>
        </div>    
      @endcan
      <div class="row g-3 mt-1">
        @foreach ($staff as $employee)
          <div class="col-4" role="button">
            <a href="{{ route('staff.show', $employee->id) }}" class="p-3 border rounded nav-link">
              <div class="fw-semibold">
                {{ $employee->full_name }}
              </div>          
              <div class="d-flex mt-1">
                <div>
                  {{ $employee->email }}
                </div>            
                <div class="fw-light ms-auto">
                  {{ $employee->position }}
                </div>
              </div>          
            </a>
          </div>
        @endforeach            
      </div>
      <div class="d-flex justify-content-start mt-3">
        {!! $staff->links() !!}
      </div>
    </div>

  </div>
</x-app-layout>