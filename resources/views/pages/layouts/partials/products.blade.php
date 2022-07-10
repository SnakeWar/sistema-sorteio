<div id="product-list" class="row d-flex justify-content-center align-items-center">
    @foreach($products as $product)
        <div class="col-md-4 col-sm-12">
            <div class="card text-center">
{{--                <a href="{{route('product_detail', $product->slug)}}">--}}
{{--                    <div class="card-header">--}}
{{--                            {{$products->categories->first()}}--}}
{{--                    </div>--}}
                    <img class="card-img-top " src="{{asset("storage/{$product->photo}")}}" alt="Produto">
                    <div class="card-body">
                        <div class="card-text">
                            {{$product->title}}
                        </div>
                        {{-- <p class="card-text">
                            {!!$product->description!!}
                        </p> --}}
                        @if(!empty($product->price))
                            <h5>{{$product->price}}</h5>
                        @else
                            <h5>&nbsp;</h5>
                        @endif
{{--                        --}}
                    </div>
{{--                </a>--}}

                <div class="card-body">
{{--                    <a href="{{route('product_detail', $product->slug)}}" class="text-white btn-comprar">--}}
{{--                        <img src="{{asset('images/min/produtos/icon-cart.png')}}"> Comprar--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>
    @endforeach
</div>
