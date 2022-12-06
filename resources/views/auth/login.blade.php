<x-guest-layout>
  <div class="d-flex align-items-center justify-content-center h-100">
    <div class="w-50 border rounded p-5 bg-light">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input 
          name="email"
          type="email" 
          class="form-control @error('email') is-invalid @enderror" 
          id="email" 
          aria-describedby="emailHelp" 
          required> 
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>   
          @enderror      
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="password" required>
        </div>    

        <div class="mb-3 form-check">
          <input name="remember" type="checkbox" class="form-check-input" id="remember_me">
          <label class="form-check-label" for="remember_me">Запомнить меня</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Войти</button>
      </form>
    </div>  
  </div>  
</x-guest-layout>