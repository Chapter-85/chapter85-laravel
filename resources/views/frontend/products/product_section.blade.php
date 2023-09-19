<div class="col-sm-12 col-md-3 col-lg-3 mb-60 mb-xs-40">

    <div class="post-prev-img boxed w-100">
        <a href="{{ route('single-product', $product->id) }}"><img src="{{ $product->product_picture_url }}"
                alt=""></a>
        <a href="{{ route('single-product', $product->id) }}" class="quick-view"> {{ __('home_page.quick_view') }}</a>
    </div>
    <div class="post-prev-title font-alt align-center">
        <a href="{{ route('single-product', $product->id) }}">{{ $product->name }}
            {{-- {{ dd($product->productsQuantity()) }} --}}
            @if ($product->productsQuantity() != null)
                <div class="intro-label">
                    <span class="badge badge-primary bg-green">{{ __('home_page.in_stock') }}</span>
                </div>
            @else
                <div class="intro-label">
                    <span class="badge badge-danger bg-red">{{ __('home_page.not_availabe') }}</span>
                </div>
            @endif
        </a>
    </div>

    <div class="post-prev-text align-center">
        <strong>{{ $product->getProductPrice() }}</strong>
    </div>



</div>
