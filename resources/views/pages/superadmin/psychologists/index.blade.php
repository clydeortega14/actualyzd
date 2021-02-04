@extends('admin-layouts.master')


@section('title', 'Psychologists')


@section('content')
	
	<div class="container-fluid">
		<div class="block-header">
	        <h2>PSYCHOLOGISTS LISTS</h2>
	    </div>

	    <div class="row clearfix">
	    	<div class="col-12">
	    		<div class="card">
	    			<div class="header">
	    				<h2></h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
	    			</div>

	    			<div class="body" id="main">
	    				<div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered basic-datatable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($psychologists as $psychologist)
                                        <tr>
                                            <td>
                                            	<div class="user-info">
                                                	<div class="image">
                                                		<img src="{{ $psychologist->my_avatar }}" height="48" width="48" class="img-circle">
                                                	</div>
                                            	</div>
                                            </td>
                                            <td>{{ $psychologist->full_name }}</td>
                                            <td>{{ $psychologist->email }}</td>
                                            <td>{{ $psychologist->contact_number }}</td>
                                            <td>
                                                <span class="label bg-red">Inactive</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs">
                                                    <i class="material-icons">info</i>
                                                </a> |

                                                <a href="#" class="btn btn-info btn-xs activate-button">
                                                    <i class="material-icons">visibility</i>
                                                </a>
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