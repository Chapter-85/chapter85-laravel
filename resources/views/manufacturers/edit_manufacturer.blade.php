<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Manufacturer</h4>
            </div>

            <div class="card-body">
                <form class="row  needs-validation" action="{{ route('manufacturers.update', $manufacturer->id) }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-3 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="name" class="form-label">Manufacturer Name / 生產商名稱 </label>
                            <input type="text"
                                class="form-control @if ($errors->has('name')) is-invalid @endif" id="name"
                                name="name" placeholder="Manufacturer name" value="{{ $manufacturer->name }}"
                                required>
                            <div class="invalid-tooltip">
                                @if ($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @else
                                    Name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="name" class="form-label">Manufacturer Name / 生產商名稱 </label>
                            <input type="text"
                                class="form-control @if ($errors->has('name_s_ch')) is-invalid @endif" id="name_s_ch"
                                name="name_s_ch" placeholder="Manufacturer name (Simplified Chinese)"
                                value="{{ $manufacturer->name_s_ch }}">
                            <div class="invalid-tooltip">
                                @if ($errors->has('name_s_ch'))
                                    {{ $errors->first('name_s_ch') }}
                                @else
                                    Name (Simplified Chinese) is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="name" class="form-label">Manufacturer Name / 生產商名稱 </label>
                            <input type="text"
                                class="form-control @if ($errors->has('name_t_ch')) is-invalid @endif" id="name_t_ch"
                                name="name_t_ch" placeholder="Manufacturer name (Traditional Chinese)"
                                value="{{ $manufacturer->name_t_ch }}">
                            <div class="invalid-tooltip">
                                @if ($errors->has('name_t_ch'))
                                    {{ $errors->first('name_t_ch') }}
                                @else
                                    Name (Traditional Chinese) is required!
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-12 mb-3">
                        <div class="form-label-group in-border">
                            <label for="abbreviation" class="form-label">Abbreviation / 縮寫 / 缩写</label>
                            <input type="text"
                                class="form-control @if ($errors->has('abbreviation')) is-invalid @endif"
                                id="abbreviation" name="abbreviation" placeholder="Please Enter Abbreviation"
                                value="{{ $manufacturer->abbreviation }}">
                            <div class="invalid-tooltip">
                                {{ $errors->first('abbreviation') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('manufacturers.index') }}" type="button"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
