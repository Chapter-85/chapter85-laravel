<section class="page-section" id="about">
    <div class="container relative">
        <h2 class="section-title font-alt align-left mb-50 mt-40 mb-sm-40">
            Products
            <a href="{{ route('shop') }}" class="section-more right">See All Products <i class="fa fa-angle-right"></i></a>

        </h2>

        <div class="section-text">
            <div class="row">
                {{-- @forelse ($categories as $category)
                    <div class="col-md-4 col-12 mt-2">
                        <div class="card">
                            <img src="{{ $category->picture_url }}" class="image" alt="">
                            <div class="middle">
                                <a href="{{ route('shop', ['category' => $category->id]) }}" class="btn"> See
                                    Products</a>
                            </div>
                        </div>
                    </div>

                @empty --}}

                <div class="col-md-4 col-12 mt-2">
                    <div class="card">
                        <img src="{{ asset('frontend/images/productImages/1.JPG') }}" class="image" alt="">
                        <div class="middle">
                            <a href="{{ route('shop') }}" class="btn"> See
                                Products</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mt-2">
                    <div class="card">
                        <img src="{{ asset('frontend/images/productImages/2.JPG') }}" class="image" alt="">
                        <div class="middle">
                            <a href="{{ route('shop') }}" class="btn"> See
                                Products</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12 mt-2">
                    <div class="card">
                        <img src="{{ asset('frontend/images/productImages/3.JPG') }}" class="image" alt="">
                        <div class="middle">
                            <a href="{{ route('shop') }}" class="btn"> See
                                Products</a>
                        </div>
                    </div>
                </div>
                {{-- @endforelse --}}
            </div>
        </div>
    </div>
</section>
