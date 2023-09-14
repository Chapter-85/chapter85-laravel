<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Category / 更新類別 </h4>
            </div>

            <div class="card-body">
                <form class="row  needs-validation" action="{{ route('categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-4 col-sm-12 mb-3">
                        <div class="form-label-group in-border">
                            <label for="name" class="form-label">Category Name / 分類名稱 </label>
                            <input type="text"
                                class="form-control @if ($errors->has('name')) is-invalid @endif" id="name"
                                name="name" placeholder="Category name" value="{{ $category->name }}" required>
                            <div class="invalid-tooltip">
                                @if ($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @else
                                    Category Name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="name" class="form-label">Category Name / 分類名稱 (Simplified
                                Chinese)</label>
                            <input type="text"
                                class="form-control @if ($errors->has('name_s_ch')) is-invalid @endif" id="name_s_ch"
                                name="name_s_ch" placeholder="Category name (Simplified Chinese)"
                                value="{{ $category->name_s_ch }}">
                            <div class="invalid-tooltip">
                                @if ($errors->has('name_s_ch'))
                                    {{ $errors->first('name_s_ch') }}
                                @else
                                    Name (Simplified Chinese) is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="name" class="form-label">Category Name / 分類名稱 (Traditional
                                Chinese)</label>
                            <input type="text"
                                class="form-control @if ($errors->has('name_t_ch')) is-invalid @endif" id="name_t_ch"
                                name="name_t_ch" placeholder="Category name (Traditional Chinese)"
                                value="{{ $category->name_t_ch }}">
                            <div class="invalid-tooltip">
                                @if ($errors->has('name_t_ch'))
                                    {{ $errors->first('name_t_ch') }}
                                @else
                                    Name (Traditional Chinese) is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="abbreviation" class="form-label">Abbreviation / 縮寫 </label>
                            <input type="text"
                                class="form-control @if ($errors->has('abbreviation')) is-invalid @endif"
                                id="abbreviation" name="abbreviation" placeholder="Please Enter Abbreviation"
                                value="{{ $category->abbreviation }}">
                            <div class="invalid-tooltip">
                                {{ $errors->first('abbreviation') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <label for="user_id" class="form-label">Categories / 類別 </label>
                            <select class="form-select form-control mb-3" name="parent_id">
                                <option value="" @if ($category->parent_id == '') {{ 'selected' }} @endif
                                    selected>
                                    Select One
                                </option>
                                @foreach ($categories as $user)
                                    <option value="{{ $user->id }}"
                                        @if ($category->parent_id == $user->id) {{ 'selected' }} @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">Select the Category!</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="surcharge_at_category" class="form-label">Mark up at Category
                                Level / 在不同級別加價 </label>
                            <select id="surcharge_at_category" class="form-select form-control mb-3"
                                name="surcharge_at_category" required>
                                <option value="" @if ($category->surcharge_at_category == '') {{ 'selected' }} @endif
                                    selected disabled>
                                    Select One
                                </option>
                                <option value="yes" @if ($category->surcharge_at_category == 'yes') {{ 'selected' }} @endif>
                                    Yes
                                </option>
                                <option value="no" @if ($category->surcharge_at_category == 'no') {{ 'selected' }} @endif>
                                    No
                                </option>
                            </select>
                            <div class="invalid-tooltip">
                                @if ($errors->has('surcharge_at_category'))
                                    {{ $errors->first('surcharge_at_category') }}
                                @else
                                    Surcharge at Product Level is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="markup_type" class="form-label">Mark up Type (價格類別)</label>
                            <select id="markup_type" class="form-select form-control mb-3" name="markup_type"
                                @if ($category->surcharge_at_product == 'no') disabled @endif>
                                <option value="" @if ($category->markup_type == '') {{ 'selected' }} @endif
                                    selected disabled>
                                    Select One
                                </option>
                                <option value="flat" @if ($category->markup_type == 'flat') {{ 'selected' }} @endif>
                                    Flat (餵價)
                                </option>
                                <option value="percentage"
                                    @if ($category->markup_type == 'percentage') {{ 'selected' }} @endif>
                                    Percentage (定價)
                                </option>
                            </select>
                            <div class="invalid-tooltip">
                                @if ($errors->has('markup_type'))
                                    {{ $errors->first('markup_type') }}
                                @else
                                    Mark up Type is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="mark_up" class="form-label">Mark Up Amount / 加價金額 </label>
                            <input type=number step=any
                                class="form-control @if ($errors->has('mark_up')) is-invalid @endif"
                                id="mark_up" name="mark_up" placeholder="Please Enter Mark Up Amount"
                                value="{{ $category->mark_up }}" @if ($category->surcharge_at_product == 'no') disabled @endif>
                            <div class="invalid-tooltip">
                                @if ($errors->has('mark_up'))
                                    {{ $errors->first('mark_up') }}
                                @else
                                    Mark Up Amount is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('categories.index') }}" type="button"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
