
@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Listagem de pessoas</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('create.people')}}" class="btn btn-sm btn-primary">Cadastrar Pessoa</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                                        </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="table-people">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome Completo</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Telefone para contato</th>
                                <th scope="col">Data de Nascimento</th>
                                <th scope="col">votos</th>
                                <th scope="col">Texto Adicional</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
        
 </div>
    </div>
    @endsection
    
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
            
    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
         $.noConflict();
        var table = $('#table-people').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('recupera.people') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'phone', name: 'phone'},
            {data: 'data_nascimento', name: 'data_nascimento'},
            {data: 'votos', name: 'votos'},
            {data: 'text', name: 'text'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    });
    </script>
</body></html>
