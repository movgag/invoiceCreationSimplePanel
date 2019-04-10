@extends('admin.layouts.main')
@section('content')
    @if ( !empty(session('message')) )
        <div class="t_a_center alert alert-@if( !empty(session('type')) ){{ session('type') }}@else{{'warning'}}@endif">
            <strong>@if( !empty(session('type')) ){{ ucfirst(session('type')) }}@else{{'Warning'}}@endif!</strong> {!! session('message') !!}
        </div>
    @endif
    <style type="text/css">
        .note-group-select-from-files {
            display: none;
        }
    </style>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <h3 class="panel-heading">View Invoice</h3>
                <div class="panel-body">
                    <form id="TypeValidation" method="post">
                        {{ csrf_field() }}

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Customer Name</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <input readonly value="{{ old('cus_name',$data['invoice']->cus_name) }}" class="form-control" type="text" name="cus_name" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Customer address</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <input readonly value="{{ old('cus_address',$data['invoice']->cus_address) }}" class="form-control" type="text" name="cus_address" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Invoice Number</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <input readonly value="{{ old('number',$data['invoice']->number) }}" class="form-control" type="text" name="number" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Short Description</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <textarea disabled="disabled" name="description" class="summernote">{{ old('description',$data['invoice']->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="datetimepicker3" class="col-sm-2 label-on-left">Date</label>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"></label>
                                    <input readonly value="{{ old('date',\Carbon\Carbon::parse($data['invoice']->date)->format('d/m/Y')) }}" name="date" type='text' class="form-control date" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="datetimepicker3" class="col-sm-2 label-on-left">Due Date</label>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"></label>
                                    <input readonly value="{{ old('due_date',\Carbon\Carbon::parse($data['invoice']->due_date)->format('d/m/Y')) }}" name="due_date" type='text' class="form-control due_date" />
                                </div>
                            </div>
                        </div>

                        <p>Purchase Line Items</p>
                        <div class="purchase_line_items_div">
                            @if($data['invoice']->purchase_items)
                                @foreach($data['invoice']->purchase_items as $m => $pur_item)
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <select disabled="disabled" class="product_select form-control" name="product_id[]" required="required">
                                                    <option value="">-</option>
                                                    @if($data['products'])
                                                        @foreach($data['products'] as $product)
                                                            <option {{ $pur_item->product_id == $product->id ? 'selected' : ''}} data-id="{{ $product->id }}" value="{{ $product->id }}">{{ $product->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input readonly value="{{ $pur_item->quantity }}" class="form-control" placeholder="Enter quantity" type="text" name="quantity[]" required="required" />
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input readonly value="{{ $pur_item->price }}" class="form-control" placeholder="Enter Price" type="text" name="price[]" required="required" />
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input readonly value="{{ $pur_item->tax }}" class="form-control" placeholder="Enter tax" type="text" name="tax[]" required="required" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3"></div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <p>Payment Line Items</p>
                        <div class="payment_line_items_div">
                            @if($data['invoice']->payment_items)
                                @foreach($data['invoice']->payment_items as $n => $pay_item)
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <select disabled="disabled" class="type_select form-control" data-placeholder="Select type"
                                                        name="payment_type[]" required="required">
                                                    <option value="">-</option>
                                                    <option {{ $pay_item->payment_type == 'cash' ? 'selected' : '' }} value="cash">Cash</option>
                                                    <option {{ $pay_item->payment_type == 'credit' ? 'selected' : '' }} value="credit">Credit</option>
                                                    <option {{ $pay_item->payment_type == 'check' ? 'selected' : '' }} value="check">Check</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group label-floating">
                                                <label class="control-label"></label>
                                                <input readonly value="{{ $pay_item->amount }}" class="form-control" placeholder="Enter amount" type="text" name="amount[]" required="required" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3"></div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.summernote').summernote('disable');
        });
    </script>
@endsection