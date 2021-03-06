@extends('admin.layouts.main')
@section('content')
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
                <h3 class="panel-heading">Add Invoice</h3>
                <div class="panel-body">
                    <form id="TypeValidation" method="post" action="{{ route('invoices.add') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Customer Name</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <input class="form-control" type="text" name="cus_name" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Customer address</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <input class="form-control" type="text" name="cus_address" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Invoice Number</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <input class="form-control" type="text" name="number" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 label-on-left">Short Description</label>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <textarea name="description" class="summernote"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="datetimepicker3" class="col-sm-2 label-on-left">Date</label>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"></label>
                                    <input name="date" type='text' class="form-control date" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label for="datetimepicker3" class="col-sm-2 label-on-left">Due Date</label>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"></label>
                                    <input name="due_date" type='text' class="form-control due_date" />
                                </div>
                            </div>
                        </div>

                        <p>Purchase Line Items</p>
                        <div class="purchase_line_items_div">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label"></label>
                                        <select class="product_select form-control" name="product_id[]" required="required">
                                            <option value="">-</option>
                                            @if($data['products'])
                                                @foreach($data['products'] as $product)
                                                    <option data-id="{{ $product->id }}" value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label"></label>
                                        <input class="form-control" placeholder="Enter quantity" type="text" name="quantity[]" required="required" />
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label"></label>
                                        <input class="form-control" placeholder="Enter Price" type="text" name="price[]" required="required" />
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label"></label>
                                        <input class="form-control" placeholder="Enter tax" type="text" name="tax[]" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-success add_purchase_item"><i class="fa fa-plus"></i><div class="ripple-container"></div></button>
                                </div>
                            </div>
                        </div>

                        <p>Payment Line Items</p>
                        <div class="payment_line_items_div">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label"></label>
                                        <select class="type_select form-control" data-placeholder="Select type"
                                                name="payment_type[]" required="required">
                                            <option value="">-</option>
                                            <option value="cash">Cash</option>
                                            <option value="credit">Credit</option>
                                            <option value="check">Check</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label"></label>
                                        <input class="form-control" placeholder="Enter amount" type="text" name="amount[]" required="required" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-success add_payment_item"><i class="fa fa-plus"></i><div class="ripple-container"></div></button>
                                </div>
                            </div>
                        </div>

                        <button onclick="window.history.go(-1); return false;"  type="button" class="btn btn-default">Back</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var product_options = '';
        @if($data['products'])
            @foreach($data['products'] as $product)
            product_options = product_options.concat('<option data-id="{{ $product->id }}" value="{{ $product->id }}">{{ $product->name }}</option>');
            @endforeach
        @endif

        $(document).on('change','.product_select', function () {
                var token = $('input[name="_token"]').val();
               var product_id = $(this).find('option:selected').data('id');
               var quantity_input = $(this).closest('.row').find('input[name="quantity[]"]');
               var price_input = $(this).closest('.row').find('input[name="price[]"]');
               var tax_input = $(this).closest('.row').find('input[name="tax[]"]');

               if (product_id) {
                   $.ajax({
                       url: '{{ route('get.product.info.ajax') }}',
                       type: 'post',
                       data: { product_id: product_id, _token: token},
                       beforeSend: function () {
                           //
                       },
                       error: function (err) {
                           quantity_input.val('');
                           price_input.val('');
                           tax_input.val('');
                       },
                       success: function (res) {
                           quantity_input.val(1);
                           price_input.val(res.product.price);
                           tax_input.val(res.product.tax);
                       }
                   });
               } else {
                   quantity_input.val('');
                   price_input.val('');
                   tax_input.val('');
               }
            });

        $(document).on('click','.add_payment_item', function () {
            var payment_line_items_div = $('.payment_line_items_div');
            var html = '<div class="row">' +
                '<div class="col-sm-3">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label"></label>' +
                '<select class="type_select form-control" data-placeholder="Select type" name="payment_type[]" required="required">' +
                '<option value="">-</option>' +
                '<option value="cash">Cash</option>' +
                '<option value="credit">Credit</option>' +
                '<option value="check">Check</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label"></label>' +
                '<input class="form-control" placeholder="Enter amount" type="text" name="amount[]" required="required" />' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-3">' +
                '<button type="button" class="btn btn-danger remove_payment_item"><i class="fa fa-trash"></i><div class="ripple-container"></div></button>' +
                '</div>' +
                '</div>';
            payment_line_items_div.append(html);
        });

        $(document).on('click','.remove_payment_item', function () {
            $(this).closest('.row').remove();
        });

        $(document).on('click','.add_purchase_item', function () {
            var purchase_line_items_div = $('.purchase_line_items_div');
            var html = '<div class="row">' +
                '<div class="col-sm-3">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label"></label>' +
                '<select class="product_select form-control" name="product_id[]" required="required">' +
                '<option value="">-</option>' +
                 product_options +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label"></label>' +
                '<input class="form-control" placeholder="Enter quantity" type="text" name="quantity[]" required="required" />' +
                '</div>' +
                '</div>' +
                '' +
                '<div class="col-sm-2">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label"></label>' +
                '<input class="form-control" placeholder="Enter Price" type="text" name="price[]" required="required" />' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<div class="form-group label-floating">' +
                '<label class="control-label"></label>' +
                '<input class="form-control" placeholder="Enter tax" type="text" name="tax[]" required="required" />' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-3">' +
                '<button type="button" class="btn btn-danger remove_purchase_item"><i class="fa fa-trash"></i><div class="ripple-container"></div></button>' +
                '</div>' +
                '</div>';
                purchase_line_items_div.append(html);
        });

        $(document).on('click','.remove_purchase_item', function () {
            $(this).closest('.row').remove();
        });
        
        $('.summernote').summernote({
            height:150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear','strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['link', ['linkDialogShow']]
            ]
        });

        $('#TypeValidation').validate({
            ignore: ":hidden:not(#summernote),.note-editable.panel-body"
        });

        $(function() {
            $('.date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('.due_date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>
@endsection