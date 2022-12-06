<x-app-layout>
  <x-slot:title>{{ $client->full_name }}</x-slot:title>
  <x-slot:brand>Контакты 🠖 {{ $client->full_name }}</x-slot:brand>
  
  @can('update', $client)
  <div class="mt-3">
    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Изменить</a>
  </div>    
  @endcan

  <div class="card text-center mt-3">
    <div class="card-header">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="credentials-tab" data-bs-toggle="tab" data-bs-target="#credentials-tab-pane" type="button" role="tab" aria-controls="credentials-tab-pane" aria-selected="true">Учетные данные</button>
        </li>
        <li class="nav-item" role="presentation">          
          <button class="nav-link" id="deals-tab" data-bs-toggle="tab" data-bs-target="#deals-tab-pane" type="button" role="tab" aria-controls="deals-tab-pane" aria-selected="false" @disabled($deals->isEmpty())>Сделки</button>
        </li>    
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="credentials-tab-pane" role="tabpanel" aria-labelledby="credentials-tab" tabindex="0">          
          <div class="row">
            <p class="col-2 text-start fw-semibold">ФИО:</p> 
            <p class="col-3 text-start">{{ $client->full_name }}</p>
          </div>
          <div class="row">
            <p class="col-2 text-start fw-semibold">Номер телефона:</p> 
            <p class="col-3 text-start">{{ $client->phone_number }}</p>
          </div>
          @isset ($client->email)
          <div class="row">
            <p class="col-2 text-start fw-semibold">Email:</p> 
            <p class="col-3 text-start">{{ $client->email }}</p>
          </div>
          @endisset                             
          <div class="row">
            <p class="col-2 text-start fw-semibold">Дата создания:</p> 
            <p class="col-3 text-start">{{ \Carbon\Carbon::parse($client->created_at)->format('d.m.Y H:i:s') }}</p>
          </div>          
        </div>

        <div class="tab-pane fade" id="deals-tab-pane" role="tabpanel" aria-labelledby="deals-tab" tabindex="0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Стадия</th>
                <th scope="col">Ответственный</th>
                <th scope="col">Сумма</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($deals as $index => $deal)
                <tr>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td>{{ $deal->title }}</td>
                  <td>{{ $deal->getStage()->name }}</td>
                  <td>
                    {{-- <a href="{{ route('staff.show', $deal->staff->id) }}">{{ $deal->staff->full_name }}</a> --}}
                    <a href="#">{{ $deal->staff->full_name }}</a>
                  </td>
                  <td>{{ $deal->amount }} ₽</td>
                </tr>
              @endforeach                            
            </tbody>
          </table>
        </div>    
      </div>
    </div>
  </div>
</x-app-layout>