<div class="col sidebar">


    <!-- Widget -->
    <div class="widget">

        <h5 class="widget-title font-alt dark">{{ __('home_page.filter_by') }} <i
                class="filter-btn fa fa-chevron-down"></i></h5>


        <div class="widget-body">
            <ul class="clearlist widget-menu">

                <li>
                    <a href="{{ route('shop') }}" title="">{{ __('home_page.all_products') }}</a>
                </li>

                @forelse ($categories as $category)
                    <li>
                        <strong>
                            @if (Config::get('app.locale') == 'en')
                                <a href="{{ route('shop', ['category' => $category->id]) }}"
                                    title="">{{ $category->name }}</a>
                            @elseif (Config::get('app.locale') == 'ch')
                                <a href="{{ route('shop', ['category' => $category->id]) }}"
                                    title="">{{ $category->name_t_ch }}</a>
                            @else
                                <a href="{{ route('shop', ['category' => $category->id]) }}"
                                    title="">{{ $category->name_s_ch }}</a>
                            @endif
                        </strong>

                        @if ($category->children->count() > 0)
                            @foreach ($category->children as $childCategory)
                    <li>
                        @if (Config::get('app.locale') == 'en')
                            --- <a href="{{ route('shop', ['category' => $childCategory->id]) }}"
                                title="">{{ $childCategory->name }}</a>
                        @elseif (Config::get('app.locale') == 'ch')
                            --- <a href="{{ route('shop', ['category' => $childCategory->id]) }}"
                                title="">{{ $childCategory->name_t_ch }}</a>
                        @else
                            --- <a href="{{ route('shop', ['category' => $childCategory->id]) }}"
                                title="">{{ $childCategory->name_s_ch }}</a>
                        @endif
                    </li>
                @endforeach
                @endif

                </li>
            @empty
                <div class="alert alert-dark" role="alert"> No Category Found!</div>
                @endforelse
            </ul>
        </div>

    </div>
    <!-- End Widget -->

    <!-- Widget -->
    <div class="widget " style="display:none">

        <h5 class="widget-title font-alt">Bestsellers</h5>

        <div class="widget-body">
            <ul class="clearlist widget-posts">

                <!-- Preview item -->
                @forelse ($best_sellers as $product)
                    <li class="clearfix">
                        <a href="{{ route('single-product', $product->id) }}"><img
                                src="images/shop/previews/shop-prev-1.jpg" alt="" class="widget-posts-img"></a>
                        <div class="widget-posts-descr">
                            @if (Config::get('app.locale') == 'en')
                                <a href="{{ route('single-product', $product->id) }}"
                                    title="">{{ $product->name }}</a>
                            @elseif (Config::get('app.locale') == 'ch')
                                <a href="{{ route('single-product', $product->id) }}"
                                    title="">{{ $product->name_t_ch }}</a>
                            @else
                                <a href="{{ route('single-product', $product->id) }}"
                                    title="">{{ $product->name_s_ch }}</a>
                            @endif
                            <div>
                                {{ $product->getProductPrice() }}
                            </div>
                        </div>
                    </li>
                @empty
                    <div class="alert alert-dark" role="alert"> No Category Found!</div>
                @endforelse

            </ul>
        </div>
    </div>
    <div class="widget" style="display:none">
        <h5 class="widget-title font-alt">{{ __('home_page.manufacturer') }}</h5>
        <div class="widget-body">
            <div class="tags">
                @forelse ($manufacturers as $manufacturer)
                    @if (Config::get('app.locale') == 'en')
                        <a href="#">{{ $manufacturer->name }}</a>
                    @elseif (Config::get('app.locale') == 'ch')
                        <a href="#">{{ $manufacturer->name_t_ch }}</a>
                    @else
                        <a href="#">{{ $manufacturer->name_s_ch }}</a>
                    @endif

                @empty
                    <div class="alert alert-dark" role="alert"> No manufacturer Found!</div>
                @endforelse

            </div>
        </div>
    </div>
</div>
