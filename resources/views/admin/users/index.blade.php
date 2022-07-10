@extends('adminlte::page')
@section('css')
    <style>
        .table .action{
            text-align: center;
        }
    </style>
@endsection
@section('title_prefix', env('APP_NAME') . ' - ')
@section('title', $title)
@section('content')
            <div class="container-fluid">
                <h1 class="text-black-50">{{$title}}</h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
                    <li class="active">{{$title}}</li>
                </ol>
                <hr>
                @include('flash::message')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-5"><i class="fa fa-fw fa-plus"></i> {{$subtitle}}</a>
                <table id="myTable" class="table table-bordered table-striped data-table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Grupo</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>@foreach($item->roles as $role)
                                    {{ $role->title.' ' }}
                                @endforeach
                            </td>
                            <td class="action">
                                <div class="btn-group">
                                    <a href="{{route('admin.users.edit', [$role->id])}}" class="btn btn-sm btn-primary"><i style="color: white" class="fa fa-pencil-alt"></i></a>
                                    <form action="{{route('admin.users.destroy', [$role->id])}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" style="border-bottom-left-radius: 0;border-top-left-radius: 0"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                {!! $users->links() !!}--}}
            </div>


@stop
@section('js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@stop
