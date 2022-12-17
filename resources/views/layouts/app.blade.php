<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="user_id" content="{{ auth()->user()->id }}" />
        <title>{{ isset($title) ? $title.' | CRM' : 'А где тайтл?' }}</title>                
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body style="overflow-x: hidden">
      <div class="row" style="height: 100vh;">          
          <div class="col-2 bg-secondary">
            @include('layouts.navigation')
          </div>            
          <main class="col-10 bg-light">  
            <div class="container">              
              {{ $slot }}
            </div>            
          </main>                       
      </div>             
      <div class="toast-container position-fixed bottom-0 start-0 p-3" id="toast-container">
      </div>
      @livewireScripts   
    </body>
</html>
