<!-- Сообщения об ошибках и успехах -->
@if ($errors->any())
    <div class="alert">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if(session()->has('message'))
    <div class="alertMessage">
        <div> {{ session()->get('message') }} </div>
    </div>
@endif