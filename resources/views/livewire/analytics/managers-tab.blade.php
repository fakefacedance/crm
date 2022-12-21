<div>
    <div class="bg-white border rounded p-3 mt-3">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Менеджер</th>
            <th scope="col">Сделки</th>
            <th scope="col">Уникальные клиенты</th>
            <th scope="col">Отказы / %</th>
            <th scope="col">Средний чек</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($managers as $manager)
            <tr>              
              <td>{{ $manager->full_name }}</td>
              <td>{{ $this->getDealsCount($manager) }}</td>
              <td>{{ $this->getUniqueClientsCount($manager) }}</td>
              <td>{{ $this->getFailedDealsCount($manager) }} / {{ $this->getFailedDealsPercent($manager) }}</td>
              <td>{{ $this->getAverageReceipt($manager) }} ₽</td>
            </tr>
          @endforeach                    
        </tbody>
      </table>

      {{ $managers->links() }}
    </div>
</div>
