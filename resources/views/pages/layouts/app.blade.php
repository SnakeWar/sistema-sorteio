<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layouts.block.head')

    <style>
        .box-cookies.hide {
            display: none !important;
        }

        .box-cookies {
            position: fixed;
            background: rgba(0, 0, 0, .9);
            width: 100%;
            z-index: 998;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .box-cookies .msg-cookies,
        .box-cookies .btn-cookies {
            text-align: center;
            padding: 25px;
            color: #fff;
            font-size: 18px;
            margin: 0;
        }

        .box-cookies .btn-cookies {
            background: #e22524;
            cursor: pointer;
            align-self: normal;
            border: none;
        }

        @media screen and (max-width: 600px) {
            .box-cookies {
                flex-direction: column;
            }
        }
    </style>
</head>
<!-- preloader -->
<div id="preloader">
    <div class="inner">
        <div class="pulsex">
            <img class="w-100" src="{{ asset('assets/img/logo-oab.svg') }}">
        </div>
    </div>
</div>
{{--Acessibilidade--}}
<body id="header-top">
{{--<a href="#" id="open-acessibilidade"><img src="{{asset('assets/img/icons/acessibilidade.svg')}}"></a>--}}

{{--        <section class="acessibilidade">--}}
{{--            <div class="topo-acessibilidade">--}}
{{--                <h2>ACESSIBILIDADE</h2>--}}
{{--                <a href="#" id="close-acessibilidade"><img src="{{asset('assets/img/icons/btn-close.svg')}}"></a>--}}
{{--            </div><!-- topo-acessibilidade -->--}}
{{--            <div class="box">--}}
{{--                <h4><img src="{{asset('assets/img/icons/contraste.svg')}}"> Ajustes de Cor</h4>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="item">--}}
{{--                            <a href="">--}}
{{--                                <img src="{{asset('assets/img/icons/lua.svg')}}">--}}
{{--                                <p>Alto Contraste</p>--}}
{{--                            </a>--}}
{{--                        </div><!-- item -->--}}
{{--                        <label for="cinza">--}}
{{--                            <span>Escala de cinza invertida</span>--}}
{{--                            <input type="radio" id="cinza" name="ajustes_cor" value="Escala de cinza invertida" class="option-input">--}}
{{--                        </label>--}}
{{--                    </div><!-- lg-4 -->--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="item">--}}
{{--                            <a href="">--}}
{{--                                <img src="{{asset('assets/img/icons/olho.svg')}}">--}}
{{--                                <p>Monocromático</p>--}}
{{--                            </a>--}}
{{--                        </div><!-- item -->--}}
{{--                        <label for="invertidas">--}}
{{--                            <span>Cores invertidas</span>--}}
{{--                            <input type="radio" id="invertidas" name="ajustes_cor" value="Cores invertidas" class="option-input">--}}
{{--                        </label>--}}
{{--                    </div><!-- lg-4 -->--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="item">--}}
{{--                            <a href="">--}}
{{--                                <img src="{{asset('assets/img/icons/sol.svg')}}">--}}
{{--                                <p>Aumentar Contraste</p>--}}
{{--                            </a>--}}
{{--                        </div><!-- item -->--}}
{{--                        <label for="escuro">--}}
{{--                            <span>Modo escuro</span>--}}
{{--                            <input type="radio" id="escuro" name="ajustes_cor" value="Modo escuro" class="option-input">--}}
{{--                        </label>--}}
{{--                    </div><!-- lg-4 -->--}}
{{--                </div><!-- row -->--}}
{{--                <a class="btn-reload"><img src="{{asset('assets/img/icons/reload2.svg')}}"> Nenhum</a>--}}

{{--                <hr class="my-4">--}}

{{--                <h4><img src="{{asset('assets/img/icons/texto.svg')}}"> Ajustes de Texto</h4>--}}
{{--                <div class="toggleWrapper">--}}
{{--                    <p>Fonte legível</p>--}}
{{--                    <input class="dn" type="checkbox" id="dn"/>--}}
{{--                    <label class="toggle" for="dn"><span class="toggle__handler"></span></label>--}}
{{--                </div><!-- toggleWrapper -->--}}

{{--                <label class="range-acessibilidade">--}}
{{--                    <p>Tamanho da fonte</p>--}}
{{--                    <input class="range" type="range" name="" value="0" min="0" max="100" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)"></input>--}}
{{--                </label>--}}
{{--                <label class="range-acessibilidade">--}}
{{--                    <p>Espaçamento do texto</p>--}}
{{--                    <input class="range" type="range" name="" value="0" min="0" max="100" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)"></input>--}}
{{--                </label>--}}
{{--                <label class="range-acessibilidade">--}}
{{--                    <p>Espaçamento entre linhas</p>--}}
{{--                    <input class="range" type="range" name="" value="0" min="0" max="100" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)"></input>--}}
{{--                </label>--}}

{{--                <hr class="my-4">--}}

{{--                <h4><img src="{{asset('assets/img/icons/conteudo.svg')}}"> Ajustes de Conteúdo</h4>--}}
{{--                <div class="d-flex">--}}
{{--                    <div class="toggleWrapper">--}}
{{--                        <p>Lupa</p>--}}
{{--                        <input class="dn" type="checkbox" id="dn2"/>--}}
{{--                        <label class="toggle" for="dn2"><span class="toggle__handler"></span></label>--}}
{{--                    </div><!-- toggleWrapper -->--}}
{{--                    <div class="toggleWrapper">--}}
{{--                        <p class="ml-4">Destacar links</p>--}}
{{--                        <input class="dn" type="checkbox" id="dn3"/>--}}
{{--                        <label class="toggle" for="dn3"><span class="toggle__handler"></span></label>--}}
{{--                    </div><!-- toggleWrapper -->--}}
{{--                </div><!-- d-flex -->--}}
{{--            </div><!-- box -->--}}
{{--        </section><!-- acessibilidade -->--}}

{{--FIM Acessibilidade--}}
@yield('css')
@include('pages.layouts.block.header')
@yield('content')
@include('pages.layouts.block.footer')
@include('pages.layouts.block.script')
@yield('js')

{{--<div class="box-cookies hide">--}}
{{--    <p class="msg-cookies">Utilizamos cookies para assegurar que lhe fornecemos a melhor experiência na nossa página web.</p>--}}
{{--    <button class="btn-cookies">Aceitar!</button>--}}
{{--</div>--}}

{{--<script>--}}
{{--    // Block cookies--}}
{{--    (() => {--}}
{{--        if (!localStorage.pureJavaScriptCookies) {--}}
{{--            document.querySelector(".box-cookies").classList.remove('hide');--}}
{{--        }--}}

{{--        const acceptCookies = () => {--}}
{{--            document.querySelector(".box-cookies").classList.add('hide');--}}
{{--            localStorage.setItem("pureJavaScriptCookies", "accept");--}}
{{--        };--}}

{{--        const btnCookies = document.querySelector(".btn-cookies");--}}

{{--        btnCookies.addEventListener('click', acceptCookies);--}}
{{--    })();--}}
{{--</script>--}}

</body>
</html>
