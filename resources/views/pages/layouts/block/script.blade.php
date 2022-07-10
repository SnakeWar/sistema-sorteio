<script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="https://kit.fontawesome.com/daa729d255.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/cbpHorizontalMenu.js')}}"></script>

<!-- scripts  -->
<script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>
@section('js')
    <script>
        $('.owl-menu').owlCarousel({
            loop:false,
            margin:30,
            nav:true,
            dots:false,
            autoplay:false,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            navText:["<img src='{{env('APP_URL')}}/assets/img/icons/btn-prev.svg'>","<img src='{{env('APP_URL')}}/assets/img/icons/btn-next.svg'>"],
            responsive:{
                0:{
                    items:2,
                    margin:5
                },
                800:{
                    items:3
                },
                1100:{
                    items:4
                }
            }
        });
        $('.owl-vitrine').owlCarousel({
            loop:true,
            margin:0,
            nav:true,
            dots:false,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            navText:["<img src='{{env('APP_URL')}}/assets/img/icons/btn-vitrine-prev.svg'>","<img src='{{env('APP_URL')}}/assets/img/icons/btn-vitrine-next.svg'>"],
            responsive:{
                0:{
                    items:1
                },
                800:{
                    items:1
                },
                1100:{
                    items:1
                }
            }
        });
        $('.owl-agenda').owlCarousel({
            loop:false,
            margin:20,
            nav:true,
            dots:true,
            autoplay:false,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            navText:["<img src='{{env('APP_URL')}}/assets/img/icons/btn-agenda-prev.svg'>","<img src='{{env('APP_URL')}}/assets/img/icons/btn-agenda-next.svg'>"],
            responsive:{
                0:{
                    items:1
                },
                800:{
                    items:2
                },
                1100:{
                    items:3
                }
            }
        });
        $('.owl-outros-destaques').owlCarousel({
            loop:true,
            margin:30,
            nav:false,
            dots:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            navText:["<img src='{{env('APP_URL')}}/assets/img/icons/btn-agenda-prev.svg'>","<img src='{{env('APP_URL')}}/assets/img/icons/btn-agenda-next.svg'>"],
            responsive:{
                0:{
                    items:1
                },
                800:{
                    items:1
                },
                1100:{
                    items:2
                }
            }
        });
        $('.owl-galeria').owlCarousel({
            loop:true,
            margin:0,
            nav:false,
            dots:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            navText:["<img src='{{env('APP_URL')}}/assets/img/icons/btn-agenda-prev.svg'>","<img src='{{env('APP_URL')}}/assets/img/icons/btn-agenda-next.svg'>"],
            responsive:{
                0:{
                    items:1
                },
                800:{
                    items:1
                },
                1100:{
                    items:1
                }
            }
        });
    </script>
@endsection
