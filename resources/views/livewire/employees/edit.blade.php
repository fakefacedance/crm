<div>
  <x-slot:title>{{ $employee->full_name }}</x-slot:title>
  <x-layouts.navbar :brand="'Контакты 🠖 '.$employee->full_name.' 🠖 Изменить'" />

  <form wire:submit.prevent='updateEmployee' class="mt-3 border rounded p-3 bg-white">
    @csrf
    @method('PUT')

    <input type="hidden" name="employee_id" value="{{ $employee->id }}">       
    
    <div class="row mb-3">
      <div class="col-4">
        <label for="full_name" class="form-label">ФИО</label>
        <input
        wire:model='employee.full_name'
        name="full_name"
        type="text" 
        class="form-control form-control-sm @error('full_name') is-invalid @enderror" 
        id="full_name"           
        required> 
        @error('full_name')
          <div class="invalid-feedback">{{ $message }}</div>   
        @enderror
      </div>
      <div class="col-4">
        <label for="email" class="form-label">Email</label>
        <input
        wire:model='employee.email'
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
      <div class="col-4">
        <label for="phone_number" class="form-label">Номер телефона</label>
        <input
        wire:model='employee.phone_number'
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
    </div>

    <div class="row mb-3">
      <div class="col-6">
        <label for="position" class="form-label">Должность</label>
        <input
        wire:model='employee.position'
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
      <div class="col-6">
        <label for="role" class="form-label">Роль(и)</label>        
          @foreach ($roles as $index => $role)
            <div class="form-check">
              <input 
              wire:model="roles.{{ $index }}.checked"
              class="form-check-input" 
              type="checkbox"               
              id="role-{{ $role->name }}">
              <label class="form-check-label" for="role-{{ $role->name }}">
                {{ $role->name }}
              </label>
            </div>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-6">
        <label for="password" class="form-label">Новый пароль</label>
        <input
        wire:model='password'
        name="password" 
        type="password" 
        class="form-control form-control-sm @error('password') is-invalid @enderror" 
        id="password">
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>   
        @enderror
      </div>
      <div class="col-6">
        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
        <input
        wire:model='password_confirmation'
        name="password_confirmation" 
        type="password" 
        class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" 
        id="password_confirmation">
        @error('password_confirmation')
          <div class="invalid-feedback">{{ $message }}</div>   
        @enderror
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Подтвердить</button>
  </form>
</div>