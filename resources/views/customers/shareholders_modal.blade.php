<div id="shareholderModel" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form class="row" id="shareholderForm" action="{{ route('customer-shareholders.store') }}"
                    method="POST">
                    @csrf
                    <input type="text" name="form_info" value="shareholder_modal" hidden>
                    <input type="text" id="customer_id" name="customer_id" value="{{ $customer_id }}" hidden>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="passport_no" class="form-label">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control  @if ($errors->has('name')) is-invalid @endif"
                                    placeholder="{{ __('shareholder.full_name') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="passport_no" class="form-label">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @if ($errors->has('title')) is-invalid @endif"
                                    placeholder="{{ __('shareholder.title') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="passport_no" class="form-label">Email</label>
                                <input type="text" value="{{ old('email') }}" name="email"
                                    class="form-control @if ($errors->has('email')) is-invalid @endif"
                                    placeholder="{{ __('shareholder.email') }}" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="passport_no" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                    class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                    placeholder="{{ __('shareholder.phone_number') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="passport_no" class="form-label">HKID NO. / PASSPORT
                                    NUMBER</label>
                                <input type="text" name="passport_no" value="{{ old('passort_no') }}"
                                    class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                                    placeholder="{{ __('shareholder.passport_no') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="passport_no" class="form-label">Nationality</label>
                                <input type="text" name="nationality" value="{{ old('nationality') }}"
                                    class="form-control @if ($errors->has('nationality')) is-invalid @endif"
                                    placeholder="{{ __('shareholder.nationality') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="passport_no" class="form-label">Address</label>
                                <input type="text" name="address" value="{{ old('address') }}"
                                    class="form-control @if ($errors->has('address')) is-invalid @endif"
                                    placeholder="{{ __('shareholder.address') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 modal-footer">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-primary" id="save_changes_shareholder"
                                data-target="#shareholderModel" data-url="{{ route('load-shareholders') }}">Save
                                Changes</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                <div class="row mt-3">
                    <table id="shareholders" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Passport Number</th>
                                <th>Nationality</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shareholders as $shareholder)
                                <tr>
                                    <td>{{ $shareholder->name }}</td>
                                    <td>{{ $shareholder->title }}</td>
                                    <td>{{ $shareholder->email }}</td>
                                    <td>{{ $shareholder->phone_number }}</td>
                                    <td>{{ $shareholder->passport_no }}</td>
                                    <td>{{ $shareholder->nationality }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ __('home_page.no_record_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
