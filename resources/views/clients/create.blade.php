<x-app-layout>
  <x-slot:title>Новый контакт</x-slot:title>
  <x-slot:brand>Контакты 🠖 Новый</x-slot:brand>

  <form action="{{ route('clients.store')}}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
      <label for="full_name" class="form-label">ФИО</label>
      <input 
      name="full_name"
      type="text" 
      class="form-control @error('full_name') is-invalid @enderror" 
      id="full_name"           
      value="{{ old('full_name') }}"      
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
      value="{{ old('phone_number') }}"> 
      <div id="emailHelp" class="form-text">Необязательно</div>
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
      value="{{ old('email') }}"
      aria-describedby="emailHelp"> 
      <div id="emailHelp" class="form-text">Необязательно</div>
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>
</x-app-layout>