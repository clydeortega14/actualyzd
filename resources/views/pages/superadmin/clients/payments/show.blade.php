@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-12">
                <h3 class="mb-3 text-gray-800 mb-3">Payments</h3>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Invoice #</th>
                                        <th>Amount</th>
                                        <th>Remarks</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop