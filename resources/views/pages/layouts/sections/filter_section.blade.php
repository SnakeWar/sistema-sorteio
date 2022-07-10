<section class="filtro">
    <div class="container w3-center w3-animate-bottom">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 col-md-12 mt-5">
                <form>
                    {!! csrf_field() !!}
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <select name="segment" class="filter-input form-control select">
                                    <option value="">Todos os Segmentos</option>
                                    @foreach($segments as $segment)
                                        <option value="{{$segment->id}}">{{$segment->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="text" name="term" class="form-control" id="search-term" placeholder="Pesquisar...">
                                    <div class="input-group-prepend" id="search-button">
                                        <div class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <select class="form-control select" id="exampleFormControlSelect1" onclick="$('select[name=segment],input[name=term]').val('').trigger('change')">
                                    <option>TODOS OS PRODUTOS</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="c-select ilter-order">
                            <div class="select-wrap">
                                <select name="order" class="filter-input">
                                    <option value="">Ordenar por:</option>
                                    <option value="desc">Maior valor</option>
                                    <option value="asc">Menor valor</option>
                                </select>
                            </div><!-- select-wrap -->
                        </div> --}}

                        {{-- <div class="c-select">
                            <a class="btn btn-default btn-todos" onclick="$('select[name=segment],select[name=store],select[name=order]').val('').trigger('change')">Todos os Produtos</a>
                        </div> --}}
                    </div>
                </form>

            </div>

        </div>
    </div>
</section>
