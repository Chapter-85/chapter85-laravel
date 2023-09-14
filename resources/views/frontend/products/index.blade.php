@extends('frontend.layouts.master')

@section('content')
    @include('frontend.products.header')
    @include('layouts.flash_message')

    <section class="page-section pt-5">

        <div class="container relative shop-page">
            <div class="section-text shop-heading">
                <h1 class="hs-line-11 font-alt mb-0 mb-xs-0 playfare dark"> {{ __('home_page.OUR_RETAIL_SHOP') }}</h1>
                <p>{{ __('home_page.product_para') }}</p>
            </div>
            <div class="filters">
                <select id="cat_filters">
                    <option value="{{ route('shop') }}">{{ __('home_page.all_products') }}
                    </option>

                    @forelse ($categories as $category)
                        <option value="{{ route('shop', ['category' => $category->id]) }}"
                            @if (Request::get('category') == $category->id) {{ 'selected' }} @endif>
                            <strong>
                                @if (Config::get('app.locale') == 'en')
                                    {{ $category->name }}
                                @elseif (Config::get('app.locale') == 'ch')
                                    {{ $category->name_t_ch }}
                                @else
                                    {{ $category->name_s_ch }}
                                @endif
                            </strong>
                        </option>

                        @if ($category->children->count() > 0)
                            @foreach ($category->children as $childCategory)
                                <option value="{{ route('shop', ['category' => $childCategory->id]) }}"
                                    @if (Request::get('category') == $childCategory->id) {{ 'selected' }} @endif>
                                    @if (Config::get('app.locale') == 'en')
                                        -- {{ $childCategory->name }}
                                    @elseif (Config::get('app.locale') == 'ch')
                                        -- {{ $childCategory->name_t_ch }}
                                    @else
                                        -- {{ $childCategory->name_s_ch }}
                                    @endif
                                </option>
                            @endforeach
                        @endif

                        {{-- </option> --}}
                    @empty
                        <option data-url="{{ route('shop') }}">{{ __('home_page.all_products') }}</option>
                        {{-- <div class="alert alert-dark" role="alert"> No Category Found!</div> --}}
                    @endforelse
                </select>
                @if (Request::get('sort') == 'asc')
                    <a href="{{ route('shop', ['sort' => 'desc']) }}">{{ __('home_page.sort_by_price') }} <span><i
                                class="fa fa-solid fa-sort mr-1"></i></span></a>
                @else
                    <a href="{{ route('shop', ['sort' => 'asc']) }}">{{ __('home_page.sort_by_price') }} <span><i
                                class="fa fa-solid fa-sort mr-1"></i></span></a>
                @endif
            </div>
            <div class="row data">
                {{-- @include('frontend.products.sidebar') --}}
                <div class="col">

                    {{-- <div class="clearfix mb-40"> --}}
                    {{-- <div class="right"> --}}
                    {{-- @if (Request::get('sort') == 'asc')
                                <a href="{{ route('shop', ['sort' => 'desc']) }}">Sort By Price <span><i
                                            class="fa fa-solid fa-sort"></i></span></a>
                            @else
                                <a href="{{ route('shop', ['sort' => 'asc']) }}">Sort By Price <span><i
                                            class="fa fa-solid fa-sort"></i></span></a>
                            @endif --}}
                    {{-- <form method="post" action="#" class="form">
                                <select class="input-md round">
                                    <option>{{ __('home_page.sorting') }}</option>
                                    <option>{{ __('home_page.sorting_low_high') }}</option>
                                    <option>{{ __('home_page.sorting_high_low') }}</option>
                                </select>
                            </form> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}

                    <div class="row multi-columns-row">

                        @forelse ($products as $product)
                            @include('frontend.products.product_section')
                        @empty
                            <div class="alert alert-dark" role="alert"> No products Found</div>
                        @endforelse

                    </div>

                    <!-- Pagination -->
                    {{-- {{ $products->links() }} --}}
                    <!-- End Pagination -->

                </div>
            </div>
        </div>
    </section>
@endsection
@push('frontend.layouts.footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cat_filters').on('change', function() {
                // alert(this.value);
                window.location.href = this.value
            });
        });
    </script>
@endpush
