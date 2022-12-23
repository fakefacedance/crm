<x-app-layout>
  <x-slot:title>Новая сделка</x-slot:title>
  <x-slot:brand>Сделки - Новая</x-slot:brand>

  <form action="{{ route('deals.store') }}" method="POST">
    @csrf

    <div class="mb-3 mt-3">
      <label for="title" class="form-label">Название</label>
      <input
      name="title"
      type="text" 
      class="form-control @error('title') is-invalid @enderror" 
      id="title"           
      value="{{ old('title') }}"      
      required> 
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>
  
    <div class="mb-3">
      <label for="employee" class="form-label">Ответственный</label>
      <select name="employee" class="form-select" id="employee" required>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}">
                {{ $employee->full_name }}
            </option>
        @endforeach
      </select>
    </div>
  
    <div class="mb-3">     
      <label for="client">Клиент</label>   
      <select name="client" class="form-select" id="client">
        <option value="" selected>Нет</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}">
                {{ $client->full_name }}
            </option>
        @endforeach
      </select>
    </div>
  
    <div class="mb-3">     
      <label for="funnel">Воронка</label>   
      <select name="funnel" class="form-select" id="funnel" required>      
        @foreach ($funnels as $funnel)
            <option value="{{ $funnel->id }}">
                {{ $funnel->name }}
            </option>
        @endforeach
      </select>
    </div>
  
    <div class="mb-3">
      <label for="amount" class="form-label">Сумма</label>
      <input
      name="amount"
      type="number"    
      class="form-control @error('amount') is-invalid @enderror" 
      min="0"
      max="99999999.99"
      step="0.01"
      id="amount"           
      value="{{ old('amount') }}"      
      required>
      @error('amount')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>  
</x-app-layout>