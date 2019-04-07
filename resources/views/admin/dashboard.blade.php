@extends('admin.layouts.main')
@section('content')
    @if ( !empty(session('message')) )
        <div class="t_a_center alert alert-@if( !empty(session('type')) ){{ session('type') }}@else{{'warning'}}@endif">
            <strong>@if( !empty(session('type')) ){{ ucfirst(session('type')) }}@else{{'Warning'}}@endif!</strong> {!! session('message') !!}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <h3 class="panel-heading"><a href="{{ route('invoices.add') }}" class="btn btn-primary">+ Add</a></h3>
                    <div class="panel-body outlay-datatables">
                        <table id="example" class="table table-striped table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Customer Name</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if($data['invoices'])
                                @foreach($data['invoices'] as $invoice)
                                    <tr>
                                        <td>{{ $invoice->cus_name }}</td>
                                        <td>{{ $invoice->price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d F, Y') }}</td>
                                        <td>
                                            <a href="{{ route('invoice.edit',['id' => $invoice->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure?')" href="{{ route('invoice.delete',['id' => $invoice->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <a href="{{ route('invoice.view',['id' => $invoice->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection