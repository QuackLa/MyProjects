<!-- Если подходит время поверять или менять счётчик, то начнём выводить сообщение за 3 месяца до даты -->
@if(!$verificationDateCome->isEmpty())
    <div class="alarm">
    @forelse($verificationDateCome as $key)
        <div> Скоро поверка у счётчика: {{ $key->serial }} </div>
    @empty
    @endforelse
    </div>
@endif

@if(!$endOfServiceDateCome->isEmpty())
    <div class="alarm">
    @forelse($endOfServiceDateCome as $key)
        <div> Скоро замена счётчика: {{ $key->serial }} </div>
    @empty
    @endforelse
    </div>
@endif