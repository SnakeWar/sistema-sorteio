@extends('adminlte::page')
@section('title_prefix', env('APP_NAME') . ' - ')
@section('title', $title)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
        <li><a href="{{ route('admin.modules.index') }}" class="pr-1"> {{$title}} /</a></li>
        <li class="active"> {{isset($module) ? 'Editar' : 'Criar'}}</li>
    </ol>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title">
                {{$subtitle}}
            </h1>
        </div>
        <div class="card-body">
            <form role="form" method="POST" action="{{ isset($module) ? route('admin.modules.update', $module->id) : route('admin.modules.store')}}" enctype="multipart/form-data">
                @csrf
                @if(!empty($module))
                    @method('PUT')
                @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="inputTitle">Título do módulo</label>
                                <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do módulo" value="{{ isset($module) ? $module->title : old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                                <label for="inputTitle">URL do módulo</label>
                                <input type="text" name="url" class="form-control" id="inputTitle" placeholder="URL do módulo" value="{{ isset($module) ? $module->url : old('url') }}">
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group @error('description') has-error @enderror">
                                <label for="inputDesc">Descrição</label>
                                <textarea name="description" class="form-control" id="inputDesc" placeholder="Descrição breve do grupo" rows="4">{{ isset($module) ? $module->description : old('description') }}</textarea>
                                @error('description')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-block btn-lg btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@stop
