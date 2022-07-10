@extends('adminlte::page')
@section('title_prefix', env('APP_NAME') . ' - ')
@section('title', $title)
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
        <li><a href="{{ route('admin.users.index') }}" class="pr-1"> {{$title}} /</a></li>
        <li class="active"> {{isset($user) ? 'Editar' : 'Criar'}}</li>
    </ol>
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h1 class="card-title">{{$subtitle}}</h1>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="inputName">Nome do usuário</label>
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome do usuário" value="{{ isset($user) ? $user->name : old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="inputEmail">E-mail de login</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="teste@teste.com" value="{{ isset($user) ? $user->email : old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="inputPassword">Senha</label>
                                    <input type="password" name="password" class="form-control" id="inputPassword">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label for="inputPasswordConfirmation">Confirme a senha</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="inputRole">Grupos</label>
                                    <select class="form-control select2" name="role_id" id="inputRole" style="width: 100%;">
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}" {{ (isset($user) && isset($user->roles->id)) ? (($item->id == $user->roles->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
@stop
