<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title.' | CRM' : 'А где тайтл?' }}</title>                
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="overflow-hidden">
      <div class="row" style="height: 100vh;">          
          <div class="col-2 bg-secondary">
            @include('layouts.navigation')
          </div>            
          <main class="col-10 bg-light">  
            <div class="container">
              <nav class="navbar bg-white border border-1 rounded mt-4">
                <div class="container-fluid">
                  <span class="navbar-brand mb-0 h1">{{ $brand }}</span>
                </div>
              </nav>            
                {{ $slot }}
            </div>            
          </main>                       
      </div> 
      @livewireScripts        
    </body>
</html>
