<h2 class="titulo titulo-noticia-geral mt-5"><img src="{{asset('assets/img/icons/noticias-destaque.svg')}}"> Últimas noticias</h2>
<div class="row ultimas-noticias">
    @foreach($last_news as $item)
        <div class="col-lg-4 col-md-4">
            <img class="img-fluid" src="{{ asset("storage/$item->photo") }}">
            <h5>{{ $item->title }}</h5>
            <a href="{{ route('post', ['slug' => $item->slug]) }}">Veja mais <img src="{{asset('assets/img/icons/chevron-right-blue.svg')}}"></a>
        </div><!-- col-lg-4 -->
    @endforeach
</div><!-- row -->
<a class="btn-vermais" href="{{route('posts')}}">Ver mais</a>
