<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Nationality / 更新國籍</h4>
            </div>

            <div class="card-body">
                <form class="row  needs-validation" action="{{ route('nationalities.update', $nationality->id) }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-4 mb-3">
                        <div class="form-label-group in-border">
                            <label for="name" class="form-label">Name</label>
                            <input type="text"
                                class="form-control @if ($errors->has('name')) is-invalid @endif" id="name"
                                name="name" placeholder="Please enter" value="{{ $nationality->name }}">

                            <div class="invalid-tooltip">
                                @if ($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @else
                                    Name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-label-group in-border">
                            <label for="gamerTagName" class="form-label">Name (Traditional Chinese)</label>
                            <input type="text"
                                class="form-control @if ($errors->has('name_ch')) is-invalid @endif"
                                id="gamerTagName" name="name_ch" placeholder="Please enter"
                                value="{{ $nationality->name_ch }}">

                            <div class="invalid-tooltip">
                                @if ($errors->has('name_ch'))
                                    {{ $errors->first('name_ch') }}
                                @else
                                    Name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <label for="gamerTagName" class="form-label">Name(Simplified Chinese)</label>
                            <input type="text"
                                class="form-control @if ($errors->has('name_s_ch')) is-invalid @endif"
                                id="gamerTagName" name="name_s_ch" placeholder="Please enter"
                                value="{{ $nationality->name_s_ch }}" required>

                            <div class="invalid-tooltip">
                                @if ($errors->has('name_s_ch'))
                                    {{ $errors->first('name_s_ch') }}
                                @else
                                    Name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-md-6 mb-3">
                        <div class="form-label-group in-border">
                            <label for="abbreviation" class="form-label">Abbreviation</label>
                            <input type="text"
                                class="form-control @if ($errors->has('abbreviation')) is-invalid @endif"
                                id="abbreviation" name="abbreviation" placeholder="Please enter"
                                value="{{ $nationality->abbriation }}">

                            <div class="invalid-tooltip">
                                @if ($errors->has('abbreviation'))
                                    {{ $errors->first('abbreviation') }}
                                @else
                                    Abbreviation is required!
                                @endif
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('agents.index') }}" type="button"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
