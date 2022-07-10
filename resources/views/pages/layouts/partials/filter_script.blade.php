<script type="text/html" id="product-template">
    <div class="col-md-4 col-sm-12">
        <div class="card text-center">
{{--            <a href="{{route('product')}}/<%=slug%>">--}}
                <div class="card-header">
                    <%=segment.title%>
                </div>
                <img class="card-img-top" src="{{asset("storage/products/")}}/<%=file%>" alt="Produto">
                <div class="card-body">
                    <div class="card-text">
                        <%=title%>
                    </div>
                    <% if(price) { %>
                    <h5><%=price%></h5>
                    <% } %>
                    <small>Ref.: <%=code%></small>
                </div>
{{--            </a>--}}

            <div class="card-body">
{{--                <a href="{{route('product')}}/<%=slug%>" class="text-white btn-comprar">--}}
{{--                    <img src="{{asset('images/min/produtos/icon-cart.png')}}"> Comprar--}}
{{--                </a>--}}
            </div>
        </div>
    </div>
</script>

<script>
    var url = '{{route("posts")}}';
    var page = 1;
    var lastPage = {{@$last_page}}

    $(document).ready(function() {
        var win = $(window);

        // Each time the user scrolls
        win.scroll(function() {
            // End of the document reached?
            // if ($(document).height() - win.height() == win.scrollTop()) {
            if (($('#product-list').offset().top + $('#product-list').height()) < (win.height() + win.scrollTop())) {
                // $('#loading').show();
                var fields = $("form").serializeArray();
                var dataFields = {};
                for(i in fields) {
                    var field = fields[i];
                    dataFields[field.name] = field.value;
                }

                if(page < lastPage) {
                    page = page + 1;
                    $(".spinner").show();
                    $.ajax({
                        method: 'post',
                        url: url+'?page='+page,
                        data: dataFields,
                        success: function(response) {
                            $(".spinner").hide();
                            if(response && response.data.length > 0) {
                                response.data.map(function(product) {
                                    var compiled = _.template($("#product-template").html());
                                    $("#product-list").append(compiled(product));
                                })
                            }
                        }
                    })
                }
            }
        });
    });


    function doFilter() {
        var fields = $("form").serializeArray();
        var dataFields = {};
        for(i in fields) {
            var field = fields[i];
            dataFields[field.name] = field.value;
        }

        $.ajax({
            method: 'post',
            url: url,
            data: dataFields,
            success: function(response) {
                $('#product-list').html('');
                page = 1;

                if(response && response.data.length > 0) {
                    response.data.map(function(product) {
                        var compiled = _.template($("#product-template").html());
                        $("#product-list").append(compiled(product));
                    })
                } else {
                    $("#product-list").append($('<p class="text-center">Não há resultados.</p>'));
                }
            }
        })
    }

    $(".filter-input").on('change', function(evt){
        doFilter();
    });

    $("#search-button").on('click', function(evt){
        doFilter();
    });

    $("#search-term").on('keydown', function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            doFilter();
        }
    })


</script>
