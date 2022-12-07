<x-app-layout>
  <x-slot:title>Новый контакт</x-slot:title>
  <x-slot:brand>Контакты 🠖 {{ $client->full_name }} 🠖 Изменить</x-slot:brand>

  <form action="{{ route('clients.update', $client->id) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <input type="hidden" name="client_id" value="{{ $client->id }}">

    <div class="mb-3">
      <label for="full_name" class="form-label">ФИО</label>
      <input 
      name="full_name"
      type="text" 
      class="form-control @error('full_name') is-invalid @enderror" 
      id="full_name"           
      value="{{ $client->full_name }}"      
      required> 
      @error('full_name')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>

    <div class="mb-3">
      <label for="phone_number" class="form-label">Номер телефона</label>
      <input 
      name="phone_number"
      type="tel" 
      class="form-control @error('phone_number') is-invalid @enderror" 
      id="phone_number"           
      value="{{ $client->phone_number }}"        
      required> 
      @error('phone_number')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>
    
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input 
      name="email"
      type="email" 
      class="form-control @error('email') is-invalid @enderror" 
      id="email" 
      value="{{ $client->email }}">       
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>

    <button type="submit" class="btn btn-primary">Подтвердить</button>
  </form>
</x-app-layout>