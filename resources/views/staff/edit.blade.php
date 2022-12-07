<x-app-layout>
  <x-slot:title>{{ $employee->full_name }}</x-slot:title>
  <x-slot:brand>Контакты 🠖 {{ $employee->full_name }} 🠖 Изменить</x-slot:brand>

  <form action="{{ route('staff.update', $employee->id)}}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <input type="hidden" name="employee_id" value="{{ $employee->id }}">

    <div class="mb-3">
      <label for="role" class="form-label">Роль</label>
      <select name="role" class="form-select form-select-sm" id="role">
        @foreach ($roles as $role)
            <option value="{{ $role }}" @selected($employee->getRoleNames()[0] === $role)>
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
      class="form-control form-control-sm @error('full_name') is-invalid @enderror" 
      id="full_name"           
      value="{{ $employee->full_name }}"      
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
      class="form-control form-control-sm @error('position') is-invalid @enderror" 
      id="position"           
      value="{{ $employee->position }}"      
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
      class="form-control form-control-sm @error('email') is-invalid @enderror" 
      id="email" 
      value="{{ $employee->email }}"
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
      class="form-control form-control-sm @error('phone_number') is-invalid @enderror" 
      id="phone_number"           
      value="{{ $employee->phone_number }}"        
      required> 
      @error('phone_number')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror      
    </div>   
    
    <div class="mb-3">
      <label for="password" class="form-label">Новый пароль</label>
      <input 
      name="password" 
      type="password" 
      class="form-control form-control-sm @error('password') is-invalid @enderror" 
      id="password">
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror
    </div>            
    
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
      <input 
      name="password_confirmation" 
      type="password" 
      class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" 
      id="password_confirmation">
      @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>   
      @enderror   
    </div>

    <button type="submit" class="btn btn-primary">Подтвердить</button>
  </form>
</x-app-layout>