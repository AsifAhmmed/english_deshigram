@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="ajax_hashtag_list">
	<div class="container-fluid">
	  <div class="row create_destination">            
	    <div class="col-sm-12 main_content">
	        <!-- <div class="box_title">
	            <h4>宛先名は削除でお願いします。</h4>
	        </div> -->
	        <!-- <form action="{{URL::to('hashtag-list-search')}}" method="post"> -->
	        <form action="javascript:void(0);" method="post">
	        {{csrf_field()}}
	        <div id="Load" class="load" style="display: none;">
		      <div class="load__container">
		        <div class="load__animation"></div>
		        <div class="load__mask"></div>
		        <span class="load__title">Your request is processing...</span>
		      </div>
		    </div>
			<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
	        <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Location</h4>
	        <h5 id="exception_msg" style="color: red;"></h5>
	        <div class="hashtag_title left-border m-b-40">
	        	@if(session('errot_message'))
	        	<div class="alert alert-danger">
	        		{{session('errot_message')}}
	        	</div>
	        	@endif

	        	@if(session('message'))
	        	<div class="alert alert-success">
                    <p>{{ session('message') }} &#10004; </p>
	        	</div>
	        	@endif



	        	@if(session('instagram_error_msg'))
	        	<div class="alert alert-danger">
	        		{{session('instagram_error_msg')}}
	        	</div>
	        	@endif

	        	@if ( Session::has('hashtag_found_msg') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('hashtag_found_msg') }}</strong>
                    </div>
                    @endif

	        	<div class="input_box">                    
	                <div class="input-group"> 
	                	                           
	                    <input type="text" name="location" id="location" placeholder ="Enter location for search" class="" required="">
	                    
	                    <div class="input-group-append" style="margin-left: -10px;">
	                    	<button type="button" name="" id="location_search" class="btn btn-info" style="background: #06af94;">Search</button>
	                      <!-- <span class="input-group-text" id="">Search</span> -->
	                    </div>
	                </div>                   
	            </div>
	        </div>
			</form>
	    </div>
	</div>


</div>


@endsection