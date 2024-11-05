@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row clearfix mb-3">
	    	<div class="col-12">
                <h3 class="mb-3 text-gray-800">Add Payment</h3>

                <div class="card">

                    <div class="card-body">
                        {{-- Payment Form --}}
                        <payment-form></payment-form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop