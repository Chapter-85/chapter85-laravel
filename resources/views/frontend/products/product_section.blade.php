<div class="col-sm-12 col-md-3 col-lg-3 mb-60 mb-xs-40">

    <div class="post-prev-img boxed w-100">
        <a href="{{ route('single-product', $product->id) }}"><img src="{{ $product->product_picture_url }}" alt=""></a>
        <a href="{{ route('single-product', $product->id) }}" class="quick-view"> {{ __('home_page.quick_view') }}</a>
    </div>

    @if (Config::get('app.locale') == 'en')
        {{-- {{ 'Current Language is English' }} --}}
        <div class="post-prev-title font-alt align-center">
            <a href="{{ route('single-product', $product->id) }}">{{ $product->name }}
                {{-- @if ($product->productsInventory($product->id) != null) --}}



                
                    

                @if ($product->productsQuantity() != null)

                    @if(

                        ($product->valid_from != null && $product->valid_till != null) &&
                        ($product->valid_from <  \Carbon\Carbon::now() || \Carbon\Carbon::now() > $product->valid_till)
                    )
                        <div class="intro-label">
                            <span class="badge badge-danger bg-red">{{ __('home_page.not_availabe') }}</span>
                        </div>
                    @else
                    <div class="intro-label">
                        <span class="badge badge-primary bg-green">{{ __('home_page.in_stock') }}</span>
                    </div>
                    @endif
                @else
                    <div class="intro-label">
                        <span class="badge badge-danger bg-red">{{ __('home_page.not_availabe') }}</span>
                    </div>
                @endif
                        

                


                {{-- @endif --}}
                {{-- <div class="intro-label"> <span class="badge badge-danger bg-red">Sale</span></div> --}}
            </a>
        </div>
    @elseif (Config::get('app.locale') == 'ch')
        {{-- {{ 'Current Language is Chinese Traditional' }} --}}
        <div class="post-prev-title font-alt align-center">
            <a href="{{ route('single-product', $product->id) }}">{{ $product->name_t_ch }}</a>
        </div>
    @else
        {{-- {{ 'Current Language is Chinese Simple' }} --}}
        <div class="post-prev-title font-alt align-center">
            <a href="{{ route('single-product', $product->id) }}">{{ $product->name_s_ch }}</a>
        </div>
    @endif

    @if (\Auth::user() && \Auth::user()->is_verified == 1)
        <div class="post-prev-text align-center">
            <strong>{{ $product->getProductPrice() }}</strong>
        </div>
    @endif


</div>
