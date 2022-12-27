<div>
  @can('add employee')
  <div class="mt-3">
    <a href="{{ route('staff.create') }}" class="btn btn-success btn-sm">+ Добавить</a>
  </div>    
  @endcan
  <div class="row g-3 mt-1">
    @foreach ($employees as $employee)
      <div class="col-4" role="button">
        <a href="{{ route('staff.show', $employee->id) }}" class="bg-white p-3 border rounded nav-link shadow">
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
    {{ $employees->links() }}
  </div>
</div>
