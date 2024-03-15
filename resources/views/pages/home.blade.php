@extends('layouts.app')
@section('content')
<div class="container">
    <!-- slider start -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="1000">
                <img src="{{ asset('image/slide/slide1.jpeg') }}" class="d-block w-100" alt="..." />
                <div class="carousel-caption">
                    {{-- <h5>First slide label</h5> --}}
                    {{-- <p>Some representative placeholder content for the first slide.</p> --}}
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('image/slide/slide2.jpeg') }}" class="d-block w-100" alt="..." />
                <div class="carousel-caption">
                    {{-- <h5>Second slide label</h5> --}}
                    {{-- <p>Some representative placeholder content for the second slide.</p> --}}
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('image/slide/slide3.jpeg') }}" class="d-block w-100" alt="..." />
                <div class="carousel-caption">
                    {{-- <h5>Third slide label</h5> --}}
                    {{-- <p>Some representative placeholder content for the third slide.</p> --}}
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <br>

    <!-- slider end -->
    {{Form::open(['method' => 'get'])}}
    <div class="row g-3">
        <div class="col-md-2">
            {{Form::select('group', $groups, $slectedGroup,['class' => 'form-control'])}}
        </div>
        <div class="col-md-8">
            {{Form::text('keyword', $slectedKeyword, ['class' => 'form-control', 'placeholder' => 'Search...'])}}
        </div>
        <div class="col-md-2">
            {{Form::submit('Filter', ['class' => 'btn btn-warning mb-3'])}}
        </div>
    </div>
    {{Form::close()}}
    <div class="row product_list form-group">
        @foreach($products as $product)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 product" data-aos="fade-up" data-aos-delay="300">
            <img src="{{config('constants.admin_base_url')}}/image/products/{{$product->image}}" title="{{ $product->name }}" alt="{{ $product->name }}">
            <div class="info">
                <div class="name">
                    {{ $product->name }}
                </div>
                <div class="price"> 
                    &#8377; {{$product->price}}
                </div>
            </div>
            <div class="links">
                <a href="javascript:void(0)" class="more product_detail" data-detail-url="{{route('ajax.productDetail',['id' => $product->id])}}">See details</a>
                <!--                <a href="#" class="add-to">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart
                                </a>-->
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="modal fade" id="modal-product-detail">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-scroll">

                <div id="product-detail-modal-container">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(function () {
        $('.product_detail').on('click', function () {
            var url = $(this).data("detail-url");
            $.ajax({
                url: url,
                beforeSend: function () {
                    $('#product-detail-modal-container').html('');
//                    $.LoadingOverlay("show");
                },
                success: function (response) {
                    var arrayResponse = jQuery.parseJSON(response);
                    if (arrayResponse.status) {
                        $('#product-detail-modal-container').html(arrayResponse.body);
//                        $.LoadingOverlay("hide");
                        $('#modal-product-detail').modal('toggle');
                    } else {
//                        $.LoadingOverlay("hide");
                        alert(arrayResponse.message);
                    }
                },
                error: function (reject) {
                    if (reject.status == 403) {
                        alert('Oops! Unauthorized Access');
                    }
//                    $.LoadingOverlay("hide");
                }
            });
        });
    });
</script>
@endsection
