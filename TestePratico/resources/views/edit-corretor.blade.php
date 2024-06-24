@extends('template.main')

@section('content')
<title>Editar</title>
<section class="container">
    <form action="/corretores/update/{{ $corretor->id }}"  method="POST" class="container-form">
        @csrf
        @method('PUT')
        <h1>Editando:  {{ $corretor->name }}</h1>
              
        <div class="container-input-label">
            <label for="name">Nome Completo:</label>
            <input 
            type="text"
            placeholder="Nome Completo"
            id="name"
            value="{{ $corretor->name }}"
            required
            name="name"
            >
        </div>
        <div class="container-input-label">
            <label for="creci">CRECI:</label>
            <input 
            type="text"
            id="creci"
            placeholder="CRECI"
            name="creci"
            maxlength="8"
            minlength="4"
            value="{{ $corretor->creci }}"
            required
            >
        </div>
        <div class="container-input-label">
            <label for="cpf">CPF:</label>
            <input 
            type="text" 
            id="cpf"
            name="cpf"
         
            value="{{ $corretor->cpf }}"
            required
            placeholder="123.456.789-01"
            >
        </div>
        <button>Alterar</button>
    </form>
</section>

    @if (session('success'))
        <div id="notification" class="notification">
        <i class="fa-solid fa-check"></i>  {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <span id="notification" class="notification error show">
        <i class="fa-solid fa-xmark"></i>  {{ session('error') }}
        </span>
     @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div id="notification" class="notification error show">
            <i class="fa-solid fa-xmark"></i> {{ $error }}
            </div>
        @endforeach
    @endif  