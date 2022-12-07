<x-app-layout>
  <x-slot:title>Новый сотрудник</x-slot:title>
  <x-slot:brand>Контакты 🠖 Новый сотрудник</x-slot:brand>

  <form action="{{ route('staff.store')}}" method="POST" class="mt-3">
    @csrf

    <div class="mb-3">
      <label for="role" class="form-label">Роль</label>
      <select name="role" class="form-select" id="role">
        @foreach ($roles as $role)
            <option value="{{ $role }}">
                {{ $role }}
            </option>
        @endforeach
      </select>      
    </div>    
    
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
      <label for="position" class="form-label">Должность</label>
      <input 
      name="position"
      type="text" 
      class="form-control @error('position') is-invalid @enderror" 
      id="position"           
      value="{{ old('position') }}"      
      required> 
      @error('position')
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
      required>
      @error('email')
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
      value="{{ old('phone_number') }}"        
      required> 
      @error('phone_number')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>   
    
    <div class="mb-3">
      <label for="password" class="form-label">Пароль</label>
      <input 
      name="password" 
      type="password" 
      class="form-control @error('password') is-invalid @enderror" 
      id="password" 
      required>
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror
    </div>            
    
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
      <input 
      name="password_confirmation" 
      type="password" 
      class="form-control @error('password_confirmation') is-invalid @enderror" 
      id="password_confirmation" 
      required>
      @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror   
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
  </form>
</x-app-layout>