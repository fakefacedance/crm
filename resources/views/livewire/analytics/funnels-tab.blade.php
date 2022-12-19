<div>
  <div class="row mt-3">
    <div class="col-10 bg-white border rounded p-3" id="content">
      <div>
        <label for="funnel">Воронка</label>   
        <select 
        wire:model="selectedFunnelId"    
        class="form-select">
          @foreach ($funnels as $funnel)
            <option value="{{ $funnel->id }}">
              {{ $funnel->name }}
            </option>
          @endforeach
        </select>
      </div>
  
      <div id="stages">
        @foreach ($this->funnel->stages as $stage)
          <div class="row mt-3 align-items-center">
            <div class="col">{{ $stage->name }}</div>
            <div class="col" style="height: 30px;">       
              <div class="progress h-100">
                <div class="progress-bar" role="progressbar" style="width: {{ $this->getPercentOfMaxDealsCount($stage->index) }}%"></div>
              </div>
            </div>      
            <div class="col">{{ $this->getDealsCount($stage->index) }}</div>            
          </div>
        @endforeach
        <div class="row mt-3 align-items-center">
          <div class="col">Успешно реализовано</div>
          <div class="col" style="height: 30px;">       
            <div class="progress h-100">
              <div class="progress-bar" role="progressbar" style="width: {{ $this->successfulDeals->count() / $maxDealsCount * 100 }}%"></div>
            </div>
          </div>      
          <div class="col">{{ $this->successfulDeals->count() }}</div>
        </div>
        <div class="row mt-3 align-items-center">
          <div class="col">Закрыто и не реализовано</div>
          <div class="col" style="height: 30px;">       
            <div class="progress h-100">
              <div class="progress-bar" role="progressbar" style="width: {{ $this->failedDeals->count() / $maxDealsCount * 100 }}%"></div>
            </div>
          </div>      
          <div class="col">{{ $this->failedDeals->count() }}</div>
        </div>
      </div>  
    </div>
    <div class="col-2">
      <div class="bg-white border rounded p-3">
        <div class="fs-1 text-primary">
          <i class="bi bi-currency-dollar"></i>{{ $this->dealsInProcess->count() }}
        </div>
        <div>Сделок в работе</div>
      </div>
      <div class="bg-white border rounded p-3 mt-3">
        <div class="fs-1 text-danger">
          <i class="bi bi-currency-dollar"></i>{{ $this->failedDeals->count() }}
        </div>
        <div>Сделок в отказ</div>
      </div>
      <div class="bg-white border rounded p-3 mt-3">
        <div class="fs-1 text-primary">
          <i class="bi bi-calendar-check"></i> {{ App\Models\Task::where('is_completed', false)->get()->count() }}
        </div>
        <div>Задач в работе</div>
      </div>
      <div class="bg-white border rounded p-3 mt-3">
        <div class="fs-1 text-danger">
          <i class="bi bi-calendar-check"></i> {{ App\Models\Task::expired()->count() }}
        </div>
        <div>Просроченных задач</div>
      </div>
    </div>
  </div>  
</div>
