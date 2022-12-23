<x-app-layout>
  <x-slot:title>{{ $client->full_name }}</x-slot:title>  
  <x-layouts.navbar :brand='"Контакты 🠖 $client->full_name"'></x-layouts.navbar>
    
  @can('update', $client)
    <a href="{{ route('clients.custom_fields', $client->id) }}" class="btn btn-success btn-sm mt-3">Редактировать кастомные поля</a>
  @endcan

  @can('update', $client)
    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm mt-3">Изменить</a>
  @endcan
  
  @can('delete', App\Models\Client::class)
    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline-block">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm mt-3">Удалить</button>
    </form>
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
          @isset ($client->phone_number)
          <div class="row">
            <p class="col-2 text-start fw-semibold">Номер телефона:</p> 
            <p class="col-3 text-start">{{ $client->phone_number }}</p>
          </div>
          @endisset
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
          @if ($customFields->isNotEmpty()) <hr> @endif
          @foreach ($customFields as $customField)
            <div class="row">
              <p class="col-2 text-start fw-semibold">{{ $customField->name }}:</p> 
              <p class="col-3 text-start">{{ $customField->value }}</p>
            </div>
          @endforeach
        </div>

        <div class="tab-pane fade" id="deals-tab-pane" role="tabpanel" aria-labelledby="deals-tab" tabindex="0">
          <table class="table table-striped text-start">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Воронка</th>
                <th scope="col">Стадия</th>
                <th scope="col">Ответственный</th>
                <th scope="col">Сумма</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($deals as $index => $deal)
                <tr>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td>
                    <a href="{{ route('deals.show', $deal->id) }}">{{ $deal->title }}</a>                    
                  </td>
                  <td>{{ $deal->funnel->name }}</td>
                  <td>{{ $deal->getStage()->name }}</td>
                  <td>
                    <a href="{{ route('staff.show', $deal->staff->id) }}">{{ $deal->staff->full_name }}</a>                    
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