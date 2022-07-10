@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('datetimepicker\datetimepicker.min.css') }}">
    <style>
        .selecionado {
            background-color: #0a90eb;
            color: whitesmoke;
        }

        .table td {
            text-align: center;
        }
    </style>
@endsection
@section('title_prefix', env('APP_NAME') . ' - ')
@section('title', $subtitle)
@section('dropify')
    <link rel="stylesheet" href="{{asset('dropify/css/dropify.css')}}">
    <link rel="stylesheet" href="{{asset('dropify/fonts/dropify.ttf')}}">
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}" class="pr-1"><i class="fa fa-address-card"></i> Home /</a></li>
        <li><a href="{{ route($admin . '.index') }}" class="pr-1">{{ $title }} /</a></li>
        <li class="active"> {{ isset($model) ? 'Editar '.$subtitle : 'Gerar '.$subtitle }}</li>
    </ol>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title">{{$subtitle}}</h1>
            @include('flash::message')
        </div>
        <div class="card-body">
            <div class="row">
                <button class="btn btn-primary mb-5" id="gerar-jogos">
                    Gerar Jogos
                </button>
                <button class="btn btn-success mb-5 ml-5" id="salvar-jogos">
                    Salvar Jogos
                </button>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="numeros">Últimas Dezenas Sorteadas</label>
                    <table id="dezenas" class="table table-primary">
                        <tr>

                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="numeros">Excluir números</label>
                        <select name="numeros[]" multiple class="form-control select2" id="numeros">
                            @php
                                for($i = 1 ; $i <= 25 ; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="app">

            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                maximumSelectionLength: 4
            });
        });
    </script>
    <script>
        const urlBase = 'http://localhost:8000'
        var jogos = [];
        getLoteriaApi();
        $('#gerar-jogos').click(function () {
            $('#app').html("");
            var numSelect = $('#numeros').val();
            numSelect = numSelect.map(it => parseInt(it));
            console.log(numSelect);
            var numCartelas = 1;
            while (numCartelas <= 15) {
                gerarJogo(numCartelas, 25, jogos, numSelect);
                numCartelas++;
            }
        });
        $('#salvar-jogos').click(function () {
            data = {games: jogos.toString()};
            $.ajaxSetup({
                headers:
                    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.post(urlBase + '/api/games/store', data).then(function (res) {
                alert('Jogo Salvo!', res);
                getJogos();
            }).catch(function (error) {
                console.log(error);
            });
        });

        async function getLoteriaApi() {
            await $.get(urlBase + '/api/configurations').then(function (res) {
                let dezenas = res.dezenas.split(',').map(it=>parseInt(it));
                console.log(dezenas);
                $.each(dezenas, function (key, value) {
                    $('#dezenas tr').append('<td>' + value + '</td>');
                });
            }).catch(function (error) {
                console.log(error);
            });
        }

        async function getJogos() {
            await $.get(urlBase + '/api/games').then(function (res) {
                console.log(res);
                return res;
            }).catch(function (error) {
                console.log(error);
            });
        };

        async function gerarJogo(cartela, maxNum, jogos, numSelect) {
            await $('#app').append('<div class="col-lg-3 col-md-6 col-sm-12 mb-5" id="cartela-' + cartela + '"><div>');
            var htmlCartela =
                '<div class="row"><div class="col-12"><h2 class="text-center">Jogo - ' + cartela + '</h2></div></div>' +
                '<table id="c' + cartela + '" class="table table-danger">' +
                '<tr>' +
                '<td class="n1">01</td>' +
                '<td class="n2">02</td>' +
                '<td class="n3">03</td>' +
                '<td class="n4">04</td>' +
                '<td class="n5">05</td>' +
                '</tr>' +
                '<tr>' +
                '   <td class="n6">06</td>' +
                '   <td class="n7">07</td>' +
                '   <td class="n8">08</td>' +
                '   <td class="n9">09</td>' +
                '   <td class="n10">10</td>' +
                '</tr>' +
                '<tr>' +
                '   <td class="n11">11</td>' +
                '   <td class="n12">12</td>' +
                '   <td class="n13">13</td>' +
                '   <td class="n14">14</td>' +
                '   <td class="n15">15</td>' +
                '</tr>' +
                '<tr>' +
                '   <td class="n16">16</td>' +
                '   <td class="n17">17</td>' +
                '   <td class="n18">18</td>' +
                '   <td class="n19">19</td>' +
                '   <td class="n20">20</td>' +
                '</tr>' +
                '<tr>' +
                '<td class="n21">21</td>' +
                '<td class="n22">22</td>' +
                '<td class="n23">23</td>' +
                '<td class="n24">24</td>' +
                '<td class="n25">25</td>' +
                '</tr>' +
                '</table>';
            $('#cartela-' + cartela).append(htmlCartela);
            var jogo = [];
            while (jogo.length < 15) {
                var num = Math.floor(Math.random() * maxNum) + 1;
                if ($.inArray(num, jogo) == -1 && $.inArray(num, numSelect) == -1) {
                    console.log(num);
                    jogo.push(num);
                }
            }
            $.each(jogo, function (key, value) {
                $('#c' + cartela + ' .n' + value).addClass('selecionado');
            });
            jogos.push(jogo);
        }
    </script>
@stop
