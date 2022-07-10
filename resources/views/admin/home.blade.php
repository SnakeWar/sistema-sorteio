@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bem vindo, <b>{{ \Illuminate\Support\Facades\Auth::user()->name }}</b>!</p>

@stop

@section('js')
{{--    <script> console.log('Hi!'); </script>--}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $(selector).inputmask("99-9999999");  //static mask--}}
{{--            $(selector).inputmask({"mask": "(999) 999-9999"}); //specifying options--}}
{{--            $(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>--}}
{{--    <script>--}}
{{--        ClassicEditor--}}
{{--            .create( document.querySelector( '#editor' ) )--}}
{{--            .then( editor => {--}}
{{--                console.log( editor );--}}
{{--            } )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}
@stop
