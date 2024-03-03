@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="block-header">
	        <h3>Manage Psychologists</h3>
	    </div>

	    <div class="row clearfix" id="#main">
	    	<div class="col-12">

                @include('alerts.message')

	    		<div class="card">
	    			<div class="card-header">
	    				All Psychologists
                        <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#create-new-psychologist">
                            <i class="fa fa-plus"></i>
                            <span>Create New Psychologist</span>

                        </a>

                        @include('pages.superadmin.psychologists.modals.create')
	    			</div>

	    			<div class="card-body">
	    				<div class="table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $psychologists->links() }}
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="search" class="form-control" placeholder="Search Psychologist...">
                                </div>
                            </div>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($psychologists as $psychologist)
                                            @php
                                                $isActive = $psychologist->is_active;
                                            @endphp
                                        <tr>
                                            <td>
                                                <a href="{{ route('user.profile', auth()->user()->id) }}">
                                                  <img src="{{ is_null($psychologist->avatar) || !file_exists(public_path().'/storage/'.$psychologist->avatar) ? '/images/profile.png' : asset('storage/'.$psychologist->avatar) }}" height="48" width="48" class="img-circle">
                                                </a>
                                            </td>
                                            <td>{{ $psychologist->name }}</td>
                                            <td>{{ $psychologist->email }}</td>
                                            <td>
                                                
                                                <span class="badge {{ $isActive ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $isActive ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm {{ $isActive ? 'btn-danger' : 'btn-success' }} activate-button"
                                                    onclick="event.preventDefault(); document.getElementById('update-psychologist-form-{{ $psychologist->id }}').submit();">
                                                    <i class="fa {{ $isActive ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                </a>
                                                <form id="update-psychologist-form-{{ $psychologist->id }}" action="{{ route('psychologists.update', $psychologist->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	</div>

@endsection

@section('custom_js')

<script type="text/javascript" src="{{ asset('assets/sweetalert2/custom/js/custom.js') }}"></script>
    
    <script>
        
        $(function(){


            const psychologist = {

                initialize(){

                    this.globalVars()
                    this.cacheDom()
                    this.events()

                },
                events(){
                    //glolabl this
                    _this = this;

                    this.$activateBtn.click(function(e){
                        alert('test')
                        e.preventDefault()

                        _this.sweet_alert.confirmDialog()
                            .then((result) => {

                                if(result.isConfirmed){

                                    // Perform ajax request

                                    
                                    _this.sweet_alert.success('successfully activated')

                                }
                                
                            })
                            .catch( (error) => {
                                console.log(error)
                            } )
                    })
                },
                globalVars(){

                    this.sweet_alert = new SweetAlert();
                },
                main: $('#main'),
                cacheDom(){

                    this.$activateBtn = this.main.find('.activate-button')
                },
                ajax(object){


                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    return $.ajax({

                        url: object.url,
                        method: object.method,
                        data: object.data

                    }).fail(error => {

                        this.sweet_alert.error()
                    })
                }

            }

            psychologist.initialize();
        })

    </script>

@endsection