<div class="details-card">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <img class="img-fluid details-img" src="{{config('constants.admin_base_url')}}/image/products/{{$resultSet->image}}" alt="">
        </div>
        <div class="col-md-6 col-sm-12 description-container p-5">
            <div class="main-description">
                <p class="product-category mb-0">{{$resultSet->name}}</p>
                <!--<h3>iPhone 7 Graphite - 256GB</h3>-->
                <hr>
                <p class="product-price">&#8377; {{$resultSet->price}}</p>
                <div style="clear:both"></div>

                <hr>
                <p class="product-title mt-4 mb-1">About this product</p>
                <p class="product-description mb-4">
                    {{$resultSet->descriptions}}
                </p>
            </div>
        </div>
    </div>
</div>

