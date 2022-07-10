@extends('pages.layouts.app')
@section('content')
    <!-- imagens vitrines -->
    @include('pages.layouts.sections.vitrine-interna')

    <!-- seção mais acessados -->
    @include('pages.layouts.sections.acesso-rapido')

    <section class="noticias-home" id="noticias-home">
        <div class="container">
            <h2><img src="{{asset('assets/img/icons/noticias-destaque.svg')}}"> Notícias Destaque</h2>
            <div class="row noticias-destaque">
                    <div class="col-lg-8 col-md-8">
                        <img class="img-fluid" src="{{asset("storage/".$highlight[0]->photo)}}">
                        <div class="conteudo">
                            <h4>{{$highlight[0]->title}}</h4>
                            <a href="{{ route('post', ['slug' => $highlight[0]->slug]) }}">Veja mais <img src="{{asset('assets/img/icons/chevron-right-blue.svg')}}"></a>
                        </div><!-- conteudo -->
                    </div><!-- col-lg-8 -->
                    <div class="col-lg-4 col-md-4">
                        <div class="item-menor mb-4">
                            <img class="img-fluid" src="{{asset("storage/".$highlight[1]->photo)}}">
                            <div class="conteudo">
                                <h4>{{$highlight[1]->title}}</h4>
                                <a href="{{ route('post', ['slug' => $highlight[1]->slug]) }}">Veja mais <img src="{{asset('assets/img/icons/chevron-right-blue.svg')}}"></a>
                            </div><!-- conteudo -->
                        </div><!-- item-menor -->
                        <div class="item-menor">
                            <img class="img-fluid" src="{{asset('storage/'.$highlight[2]->photo)}}">
                            <div class="conteudo">
                                <h4>{{$highlight[2]->title}}</h4>
                                <a href="{{ route('post', ['slug' => $highlight[2]->slug]) }}">Veja mais <img src="{{asset('assets/img/icons/chevron-right-blue.svg')}}"></a>
                            </div><!-- conteudo -->
                        </div><!-- item-menor -->
                    </div><!-- col-lg-4 -->
            </div><!-- row -->

            @include('pages.layouts.sections.ultimas-noticias')

        </div><!-- container -->
    </section><!-- noticias-home -->

    <section class="em-destaque">
        <div class="container">
            <h2><img src="assets/img/icons/estrela.svg"> Em Destaque</h2>
            <div class="row justify-content-center">
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque1.svg">
                        <h4>Anuidade 2020</h4>
                    </a>
                </div><!-- lg-3 -->
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque2.svg">
                        <h4>Certidão Negativa</h4>
                    </a>
                </div><!-- lg-3 -->
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque3.svg">
                        <h4>Acompanhamento Processual</h4>
                    </a>
                </div><!-- lg-3 -->
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque4.svg">
                        <h4>Ouvidoria</h4>
                    </a>
                </div><!-- lg-3 -->
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque5.svg">
                        <h4>Sociedade de Advogados</h4>
                    </a>
                </div><!-- lg-3 -->
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque6.svg">
                        <h4>Busca por Inscritos</h4>
                    </a>
                </div><!-- lg-3 -->
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque7.svg">
                        <h4>Peticionamento Eletrônico</h4>
                    </a>
                </div><!-- lg-3 -->
                <div class="col-6 col-lg-3 col-md-4">
                    <a href="">
                        <img src="assets/img/icons/destaque8.svg">
                        <h4>Certificação Digital</h4>
                    </a>
                </div><!-- lg-3 -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- em-destaque -->

    <section class="agenda">
        <div class="container">
            <h2><img src="{{asset('assets/img/icons/agenda.svg')}}"> Agenda</h2>
            <div class="owl-carousel owl-theme owl-agenda">
                <div class="item">
                    <span><strong>06</strong> de junho</span>
                    <h4>
                        Alto Oeste: Webinar – Gestão Analítica e Jurimetria
                    </h4>
                    <a href="https://doity.com.br/webinar-subseo-alto-oeste--gesto-analtica-e-jurimetria" target="_blank">Inscreva-se aqui!</a>
                </div><!-- item -->
                <div class="item">
                    <span><strong>06</strong> de junho</span>
                    <h4>Assú: Webinar – Gestão Analítica e Jurimetria</h4>
                    <a href="https://doity.com.br/webinar-subseo-ass-gesto-analtica-e-jurimetria" target="_blank">Inscreva-se aqui!</a>
                </div><!-- item -->
                <div class="item">
                    <span><strong>06</strong> de junho</span>
                    <h4>Caicó: Webinar – Gestão Analítica e Jurimetria</h4>
                    <a href="https://doity.com.br/webinar-subseo-caic--gesto-analtica-e-jurimetria" target="_blank">Inscreva-se aqui!</a>
                </div><!-- item -->
                <div class="item">
                    <span><strong>06</strong> de junho</span>
                    <h4>Currais Novos: Webinar – Gestão Analítica e Jurimetria</h4>
                    <a href="https://doity.com.br/webinar-subseo-currais-novos-gesto-analtica-e-jurimetria" target="_blank">Inscreva-se aqui!</a>
                </div><!-- item -->
            </div><!-- owl-agenda -->
        </div><!-- container -->
    </section><!-- agenda -->

    <section class="outros-destaques">
        <div class="container">
            <h2><img src="{{asset('assets/img/icons/outros-destaques.svg')}}"> Outros Destaques</h2>
            <div class="owl-carousel owl-theme owl-outros-destaques">
                <div class="item">
                    <a href="">
                        <img src="assets/img/outro-destaque-1.jpg">
                    </a>
                </div><!-- item -->
                <div class="item">
                    <a href="">
                        <img src="assets/img/outro-destaque-2.jpg">
                    </a>
                </div><!-- item -->
                <div class="item">
                    <a href="">
                        <img src="assets/img/outro-destaque-1.jpg">
                    </a>
                </div><!-- item -->
                <div class="item">
                    <a href="">
                        <img src="assets/img/outro-destaque-2.jpg">
                    </a>
                </div><!-- item -->
                <div class="item">
                    <a href="">
                        <img src="assets/img/outro-destaque-1.jpg">
                    </a>
                </div><!-- item -->
                <div class="item">
                    <a href="">
                        <img src="assets/img/outro-destaque-2.jpg">
                    </a>
                </div><!-- item -->
            </div><!-- owl-outros-destaques -->
        </div><!-- container -->
    </section><!-- outros-destaques -->

    <section class="galeria" id="galeria">
        <div class="container-fluid">
            <h2><img src="assets/img/icons/galeria.svg"> Galeria</h2>
            <div class="row">
                <div class="col-lg-6 col-md-6 pl-0 pr-1">
                    <div class="owl-carousel owl-theme owl-galeria">
                            <div class="item">
                                <img class="img-fluid" src="{{asset('storage'. '/' . $galleries[0]->photos->first()->photo)}}">
                                <div class="conteudo">
                                    <a href="{{route('gallery', ['slug' => $galleries[0]->slug])}}"><h4>{{$galleries[0]->title}}</h4></a>
                                </div><!-- conteudo -->
                            </div><!-- item -->
                        <div class="item">
                            <img class="img-fluid" src="{{asset('storage'. '/' . $galleries[1]->photos->first()->photo)}}">
                            <div class="conteudo">
                                <a href="{{route('gallery', ['slug' => $galleries[1]->slug])}}"><h4>{{$galleries[1]->title}}</h4></a>
                            </div><!-- conteudo -->
                        </div><!-- item -->
                        <div class="item">
                            <img class="img-fluid" src="{{asset('storage'. '/' . $galleries[2]->photos->first()->photo)}}">
                            <div class="conteudo">
                                <a href="{{route('gallery', ['slug' => $galleries[2]->slug])}}"><h4>{{$galleries[2]->title}}</h4></a>
                            </div><!-- conteudo -->
                        </div><!-- item -->
                    </div><!-- owl-galeria -->
                </div><!-- col-lg-6 -->
                <div class="col-lg-6 col-md-6 p-0 d-none d-sm-block">
                    <div class="item-medio mb-1">
                        <img class="img-fluid" src="{{asset('storage' . '/' . $galleries[3]->photos->first()->photo)}}">
                        <div class="conteudo">
                            <a href="{{route('gallery', ['slug' => $galleries[3]->slug])}}"><h4>{{$galleries[5]->title}}</h4></a>
                        </div><!-- conteudo -->
                    </div><!-- item-medio -->
                    <div class="row m-0">
                        <div class="col-lg-6 col-md-6 pl-0 pr-1">
                            <div class="item-menor">
                                <img class="img-fluid" src="{{asset('storage' . '/' . $galleries[5]->photos->first()->photo)}}">
                                <div class="conteudo">
                                    <a href="{{route('gallery', ['slug' => $galleries[4]->slug])}}"><h4>{{$galleries[4]->title}}</h4></a>
                                </div><!-- conteudo -->
                            </div><!-- item-menor -->
                        </div><!-- col-lg-6 -->
                        <div class="col-lg-6 col-md-6 p-0">
                            <div class="item-menor">
                                <img class="img-fluid" src="{{asset('storage' . '/' . $galleries[5]->photos->first()->photo)}}">
                                <div class="conteudo">
                                    <a href="{{route('gallery', ['slug' => $galleries[5]->slug])}}"><h4>{{$galleries[5]->title}}</h4></a>
                                </div><!-- conteudo -->
                            </div><!-- item-menor -->
                        </div><!-- col-lg-6 -->
                    </div><!-- row -->
                </div><!-- col-lg-6 -->
            </div><!-- row -->
            <a class="btn-vermais mb-5" href="{{route('galleries')}}">Ver mais</a>

@include('pages.layouts.sections.redes-sociais')

        </div><!-- container-fluid -->
    </section><!-- galeria -->



@endsection
