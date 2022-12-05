<div>
  <div class="row g-3 mt-1">
    @foreach ($staff as $employee)
      <div class="col-4" role="button">
        <div class="p-3 border rounded ">
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
        </div>
      </div>
    @endforeach            
  </div>
  <div class="d-flex justify-content-start mt-3">
    {!! $staff->links() !!}
  </div>
</div>
