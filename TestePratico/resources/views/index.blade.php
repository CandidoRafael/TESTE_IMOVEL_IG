@extends('template.main')

    @section('content')
      <section class="container">

          <h1>Cadastro IMOVEL GUIDE</h1>
          <form action="/corretores" method="POST" class="container-form">
              @csrf
            @if(session('success'))
            <div id="notification" class="notification show">
            <i class="fa-solid fa-check"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div id="notification" class="notification error show">
                <i class="fa-solid fa-xmark"></i> {{ session('error') }}
            </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div id="notification" class="notification error show">
                    <i class="fa-solid fa-xmark"></i>  {{ $error }}
                    </div>
                @endforeach
            @endif  

            <div class="container-input-label">
              <label for="name">Nome Completo:</label>
                <input 
                  type="text"
                  placeholder="Nome Completo"
                  id="name"
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
                  maxlength="8"
                  minlength="2"
                  name="creci"
                  required
                >
            </div>
            <div class="container-input-label">
                <label for="cpf">CPF:</label>
                <input 
                    type="text" 
                    id="cpf"
                    name="cpf"
                    required
                    placeholder="123.456.789-01"
                >
            </div>
            <button>Criar</button>
        </form>
        
        @if ($corretores->isEmpty())
            <p>Nenhum corretor cadastrado no momento.</p>
        @else
            <div class="container-tabela">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CPF</th>
                            <th>CRECI</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($corretores as $corretor)
                            <tr>
                                <td>{{ $corretor->id }}</td>
                                <td>{{ $corretor->name }}</td>
                                <td class="table-cpf">{{ $corretor->cpf }}</td>
                                <td>{{ $corretor->creci }}</td>
                                <td>
                                    <div class="td-action">
                                        <a class="btn-edit" href="/corretores/edit/{{ $corretor->id }}}">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </a>
                                        
                                        <form action="/corretores/{{ $corretor->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button type="submit" class="btn-delete">
                                            <i class="fa-solid fa-trash"></i>
                                                
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>