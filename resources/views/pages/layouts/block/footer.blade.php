<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <a href=""><img class="img-fluid mb-4" src="{{asset('assets/img/logo-oab.svg')}}"></a>
                <h2>Busca</h2>
                <form class="d-flex justify-content-between" action="{{route('enviar_busca')}}" method="post">
                    @csrf
                    <input type="text" name="q" id="buscar" placeholder="" class="form-control">
                    <button type="submit"><img src="{{asset('assets/img/icons/chevron-right.svg')}}"></button>
                </form>
            </div><!-- col-lg-3 -->
            <div class="col-lg-3 col-md-3 d-none d-sm-block">
                <h4>Institucional</h4>
                <ul class="mb-5">
                    @foreach($pages as $item)
                        <li><a href="{{route('page', ['slug' => $item->slug])}}">{{$item->title}}</a></li>
                    @endforeach
                </ul>
                <h4>Subseccionais</h4>
                <ul>
                    @foreach($subsections as $item)
                        <li><a href="{{asset("/noticias/{$item->title}/{$item->id}")}}">{{$item->title}}</a></li>
                    @endforeach
                </ul>
            </div><!-- col-lg-3 -->
            <div class="col-lg-3 col-md-3 d-none d-sm-block">
                <h4>Serviços</h4>
                <ul class="mb-5">
                    @foreach($servicos as $item)
                        <li><a href="{{route('page', ['slug' => $item->slug])}}">{{$item->title}}</a></li>
                    @endforeach
                        <li><a href="https://www.oabrn.org.br/2017/arquivos/Resolucao-08-TAXAS-DA-SECCIONAL.pdf">Tabela de serviços</a></li>
                        <li><a href="https://deoab.oab.org.br/pages/visualizacao">Diário Eletrônico da OAB</a></li>
                </ul>
                <h4>Primeira Câmara</h4>
                <ul>
                    <li><a href="">Competência</a></li>
                    <li><a href="">Atas</a></li>
                    <li><a href="">Pautas</a></li>
                    <li><a href="">Calendário</a></li>
                    <li><a href="">Composição</a></li>
                    <li><a href="">Contato</a></li>
                </ul>
                <h4><a href="">Inscrição</a></h4>
            </div><!-- col-lg-3 -->
            <div class="col-lg-3 col-md-3 d-none d-sm-block">
                <h4>Exame de Ordem</h4>
                <ul class="mb-5">
                    <li><a href="">Certificado de Aprovação</a></li>
                    <li><a href="">Estatísticas</a></li>
                    <li><a href="">Exames anteriores</a></li>
                    <li><a href="">Exame de ordem</a></li>
                    <li><a href="">Provimentos</a></li>
                </ul>
                <h4>Comunicação</h4>
                <ul class="mb-5">
                    <li><a href="{{route('galleries')}}">Álbuns de fotos</a></li>
                    <li><a href="">Cartilhas</a></li>
                    <li><a href="">Notícias</a></li>
                    <li><a href="">Revista OAB/RN</a></li>
                    <li><a href="">Vídeos</a></li>
                    <li><a href="">Manuais</a></li>
                    <li><a href="">Informativo</a></li>
                </ul>
                <h4><a href="">ESA</a></h4>
                <h4>Revista</h4>
                <ul>
                    <li><a href="">Editais</a></li>
                    <li><a href="">Publicações</a></li>
                </ul>
                <h4><a href="">CAARN</a></h4>
                <h4><a href="">Contato</a></h4>
            </div><!-- col-lg-3 -->

            <div id="accordion" class="d-block d-sm-none">
                <div class="card">
                    <div class="card-header" id="heading01">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse01" aria-expanded="false" aria-controls="collapse01">
                            <h4>Institucional</h4>
                        </button>
                    </div><!-- card-header -->
                    <div id="collapse01" class="collapse" aria-labelledby="heading01" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="mb-2">
                                @foreach($pages as $item)
                                    <li><a href="{{route('page', ['slug' => $item->slug])}}">{{$item->title}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- card-body -->
                    </div><!-- collapse -->
                </div><!-- card -->
                <div class="card">
                    <div class="card-header" id="heading02">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse02" aria-expanded="false" aria-controls="collapse02">
                            <h4>Subseccionais</h4>
                        </button>
                    </div><!-- card-header -->
                    <div id="collapse02" class="collapse" aria-labelledby="heading02" data-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                @foreach($subsections as $item)
                                    <li><a href="{{asset("/subsecao/{$item->slug}")}}">{{$item->title}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- card-body -->
                    </div><!-- collapse -->
                </div><!-- card -->
                <div class="card">
                    <div class="card-header" id="heading03">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                            <h4>Serviços</h4>
                        </button>
                    </div><!-- card-header -->
                    <div id="collapse03" class="collapse" aria-labelledby="heading03" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="mb-2">
                                <li><a href="">Anuidade 2022</a></li>
                                <li><a href="">Isenções</a></li>
                                <li><a href="">Assistência jurídica</a></li>
                                <li><a href="">Atualização de dados cadastrais</a></li>
                                <li><a href="">Avisos de Correições</a></li>
                                <li><a href="">Busca por inscritos</a></li>
                                <li><a href="">Certificação digital</a></li>
                                <li><a href="">Convênios</a></li>
                                <li><a href="">Empregabilidade</a></li>
                                <li><a href="">Estacionamentos</a></li>
                                <li><a href="">Legislação</a></li>
                                <li><a href="">Plantão de prerrogativas</a></li>
                                <li><a href="">Sala dos Advogados</a></li>
                                <li><a href="">Sociedade de advogados</a></li>
                                <li><a href="">Tabela de honorários</a></li>
                                <li><a href="">Tabela de serviços</a></li>
                                <li><a href="">Ouvidoria</a></li>
                                <li><a href="">Diário Eletrônico da OAB</a></li>
                                <li><a href="">PJE</a></li>
                            </ul>
                        </div><!-- card-body -->
                    </div><!-- collapse -->
                </div><!-- card -->
                <div class="card">
                    <div class="card-header" id="heading03">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                            <h4>Primeira Câmara</h4>
                        </button>
                    </div><!-- card-header -->
                    <div id="collapse03" class="collapse" aria-labelledby="heading03" data-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <li><a href="">Competência</a></li>
                                <li><a href="">Atas</a></li>
                                <li><a href="">Pautas</a></li>
                                <li><a href="">Calendário</a></li>
                                <li><a href="">Composição</a></li>
                                <li><a href="">Contato</a></li>
                            </ul>
                        </div><!-- card-body -->
                    </div><!-- collapse -->
                </div><!-- card -->
                <div class="card">
                    <div class="card-header" id="heading03">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                            <h4>Exame de Ordem</h4>
                        </button>
                    </div><!-- card-header -->
                    <div id="collapse03" class="collapse" aria-labelledby="heading03" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="mb-2">
                                <li><a href="">Certificado de Aprovação</a></li>
                                <li><a href="">Estatísticas</a></li>
                                <li><a href="">Exames anteriores</a></li>
                                <li><a href="">Exame de ordem</a></li>
                                <li><a href="">Provimentos</a></li>
                            </ul>
                        </div><!-- card-body -->
                    </div><!-- collapse -->
                </div><!-- card -->
                <div class="card">
                    <div class="card-header" id="heading03">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                            <h4>Comunicação</h4>
                        </button>
                    </div><!-- card-header -->
                    <div id="collapse03" class="collapse" aria-labelledby="heading03" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="mb-2">
                                <li><a href="{{route('galleries')}}">Álbuns de fotos</a></li>
                                <li><a href="">Cartilhas</a></li>
                                <li><a href="">Notícias</a></li>
                                <li><a href="">Revista OAB/RN</a></li>
                                <li><a href="">Vídeos</a></li>
                                <li><a href="">Manuais</a></li>
                                <li><a href="">Informativo</a></li>
                            </ul>
                        </div><!-- card-body -->
                    </div><!-- collapse -->
                </div><!-- card -->
                <h4><a href="">ESA</a></h4>
                <div class="card">
                    <div class="card-header" id="heading03">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
                            <h4>Revista</h4>
                        </button>
                    </div><!-- card-header -->
                    <div id="collapse03" class="collapse" aria-labelledby="heading03" data-parent="#accordion">
                        <div class="card-body">
                            <ul>
                                <li><a href="">Editais</a></li>
                                <li><a href="">Publicações</a></li>
                            </ul>
                        </div><!-- card-body -->
                    </div><!-- collapse -->
                </div><!-- card -->
                <h4><a href="">CAARN</a></h4>
                <h4><a href="" class="h4-last">Contato</a></h4>
            </div><!-- #accordion -->
        </div><!-- row -->
    </div><!-- container -->
</footer>
<div class="rodape">
    <p>OAB-RN - Rua Barão de Serra Branca, s/n - Candelária - CEP: 59065-550; Natal/RN • Telefone (84) 4008-9400</p>
</div><!-- rodape -->
