<x-guest-layout>
  <div class="d-flex align-items-center justify-content-center h-100">
    <div class="w-50 border rounded p-5 bg-light">      
      <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="mb-3">
          <label for="full-name" class="form-label">ФИО</label>
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
          value="{{ old('phone_number') }}"        
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
          value="{{ old('email') }}"
          aria-describedby="emailHelp" 
          required> 
          @error('email')
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

        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
      </form>
    </div>  
  </div>  
</x-guest-layout>