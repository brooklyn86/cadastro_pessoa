@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => '',
        'description' => '',
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Cadastro de Pessoa') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <form method="post" action="{{ route('create.people.post') }}" autocomplete="off"  enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <h6 class="heading-small text-muted mb-4">{{ __('Informações da Pessoa') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nome Completo') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome Completo') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Endereço') }}</label>
                                    <input type="text" name="address" id="input-email" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Endereço') }}" value="{{ old('address') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Telefone para Contato') }}</label>
                                    <input type="text" name="phone" id="input-email" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }} phone" placeholder="{{ __('Telefone para Contato') }}" value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('data_nascimento') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Data de nascimento') }}</label>
                                    <input type="date" name="data_nascimento" id="input-email" class="form-control form-control-alternative{{ $errors->has('data_nascimento') ? ' is-invalid' : '' }}" placeholder="{{ __('Data de Nascimento') }}" value="{{ old('data_nascimento') }}" required>

                                    @if ($errors->has('data_nascimento'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('data_nascimento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('votos') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Quantidade de votos') }}</label>
                                    <input type="number" name="votos" id="input-email" class="form-control form-control-alternative{{ $errors->has('votos') ? ' is-invalid' : '' }}" placeholder="{{ __('Quantidade de votos') }}" value="{{ old('votos') }}" required>

                                    @if ($errors->has('votos'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('votos') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Foto') }}</label>
                                    <input type="file" name="file" id="input-email" class="form-control form-control-alternative{{ $errors->has('file') ? ' is-invalid' : '' }}" placeholder="{{ __('file') }}" value="{{ old('file') }}" required>

                                    @if ($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('text') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Notas adicionais') }}</label>
                                    <textarea  name="text" id="input-email" class="form-control form-control-alternative{{ $errors->has('text') ? ' is-invalid' : '' }}" placeholder="{{ __('Notas adicionais') }}" value="{{ old('text') }}" rows="4" required></textarea>
                                    @if ($errors->has('text'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Cadastrar Pessoa') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/assets/js/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function($){   
                $('.phone').mask('(00) 00000-0000');
            });
        </script>
    </div>
@endsection
