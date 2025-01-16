@extends('layouts.app')


@section('content')
	
	<div class="container-fluid">
		<div class="block-header">
	        <h3>Manage psychologists / wellness coach</h3>
	    </div>

	    <div class="row clearfix" id="#main">
	    	<div class="col-12">

                @include('alerts.message')

                {{-- Navs Component --}}
                <psychologist></psychologist>

	    				{{-- All Psychologists
                        <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#create-new-psychologist">
                            <i class="fa fa-plus"></i>
                            <span>Create New Psychologist</span>

                        </a>

                        @include('pages.superadmin.psychologists.modals.create') --}}
	    			
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