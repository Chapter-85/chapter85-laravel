<section class="page-section home-shop-web">
    <div class="container relative" style="min-height:540px !important">

        <h2 class="section-title font-alt align-left mt-50 mb-50 mb-sm-40">
            {{ __('home_page.BEST SELLERS') }}

            <a href="{{ route('shop') }}" class="section-more right">{{ __('home_page.Rental Shop') }} <i
                    class="fa fa-angle-right"></i></a>

        </h2>
        <div class="product-slider">
            @foreach ($slider_products as $product)
                <div class="product-item" onclick="location.href='{{ route('single-product', $product->id) }}';"
                    style="cursor: pointer;">
                    <img src="{{ $product->product_images[0]->product_picture_url }}" alt="{{ $product->name }}">
                    <h4>{{ $product->name }}</h4>
                    {{-- <p>{{ $product->description }}</p> --}}
                    <p>Price: {{ $product->getProductPrice() }}</p>
                </div>
            @endforeach
        </div>
        {{-- <div class="row multi-columns-row">

            @foreach ($products as $product)
                @include('frontend.products.product_section')
            @endforeach

        </div> --}}

    </div>
</section>
