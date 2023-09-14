<div id="tradingModel" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form class="row  needs-validation" id="tradingForm"
                    action="{{ route('customer-trading.store', $customer_id) }}" method="POST" novalidate>
                    @csrf
                    <input type="text" name="form_info" value="trading_modal" hidden>
                    <input type="text" id="customer_id" name="customer_id" value="{{ $customer_id }}" hidden>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control  @if ($errors->has('name')) is-invalid @endif"
                                    placeholder="{{ __('trading.full_name') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @if ($errors->has('title')) is-invalid @endif"
                                    placeholder="{{ __('trading.title') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Email</label>
                                <input type="text" value="{{ old('email') }}" name="email"
                                    class="form-control @if ($errors->has('email')) is-invalid @endif"
                                    placeholder="{{ __('trading.email') }}" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                    class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                    placeholder="{{ __('trading.phone_number') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Signature</label>
                                <input type="text" name="signature" value="{{ old('signature') }}"
                                    class="form-control @if ($errors->has('signature')) is-invalid @endif"
                                    placeholder="{{ __('trading.signature') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 ">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-primary" id="save_changes_trading"
                                data-url="{{ route('load-trading') }}" data-target="#tradingModel">Save
                                Changes</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </form>
                <div class="row mt-3">
                    <table id="trading-representative" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($representatives as $representative)
                                <tr>
                                    <td>{{ $representative->name }}</td>
                                    <td>{{ $representative->title }}</td>
                                    <td>{{ $representative->email }}</td>
                                    <td>{{ $representative->phone_number }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">{{ __('home_page.no_record_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
