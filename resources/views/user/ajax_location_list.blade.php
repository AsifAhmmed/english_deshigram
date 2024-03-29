

<div id="page-content-wrapper" class="ajax_location_list">
  <div class="container-fluid">
    <div class="row create_destination">            
      <div class="col-sm-12 main_content">
          <!-- <div class="box_title">
              <h4>宛先名は削除でお願いします。</h4>
          </div> -->
          <!-- <form action="{{URL::to('hashtag-list-search')}}" method="post"> -->
            <form action="javascript:void(0);" method="post">
          {{csrf_field()}}
          <!-- <div id='loader' style='display: none;'>
        <div class="loader"> </div>
      </div> -->
      <div id="Load" class="load" style="display: none;">
          <div class="load__container">
            <div class="load__animation"></div>
            <div class="load__mask"></div>
            <span class="load__title">Your request is processing...</span>
          </div>
        </div>

      <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
          <h4>Location</h4>
          <h5 id="exception_msg" style="color: red;"></h5>
          <div class="alert alert-success" id="hashtag_session_save" style="display: none;"></div>
              
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
            
                    <!-- <div class="alert alert-danger alert-dismissible hashtag_search_alert" role="alert" style="display: none;">
                        
                    </div> -->
                    
              
              <div class="input_box">                    
                  <div class="input-group"> 
                                               
                      <input type="text" name="location" id="location" placeholder="Enter location for search" class="" required="">

                      <div class="input-group-append" style="margin-left: -10px;">
                        <button type="button" name="" id="location_search" class="btn btn-info" style="background: #06af94;">Search</button>
                        <!-- <span class="input-group-text" id="">Search</span> -->
                      </div>
                  </div>                   
              </div>
          </div>
      </form>

      <div class="ajax_hashtag_list"></div>
      <!-- <div class='response'></div> -->
      <form action="{{URL::to('location-list-search-csv')}}" method="post">


          {{csrf_field()}}
          <div class="radio_list_area">
            @if(isset($results))
              <div class="radio_label">
                  <h3>Select List</h3>
              </div>
              <div class="radio_list">
                  <div class="single_radio radio1">
                <?php $i=0;?>
              @foreach($results as $result)
              @if($i < 9)
                    <label class="checkcontainer"> {{$result->location->name}}-> {{$result->location->pk}}
                      <input type="radio" id="location_list" name="location_list" value="{{$result->location->pk}" required=""><br>
                      <span class="radiobtn"></span>
                    </label>
                  @endif
                  <?php $i++;?>
                  @endforeach

                  </div>

              </div>
          </div>
          
          <div class="form_buttons">
              <!-- <button class="btn_cancel p_btn">削除する</button> -->
              <button type="button" id="ajax_locatiion_save" class="btn_done p_btn">登録</button>
          </div>
          @endif



      </form>
      </div>


<!--      <div class="envelope_area">-->
<!--       <div class="envelope">-->
<!--          <a href="#">-->
<!--            <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--          </a>-->
<!--       </div>-->
<!--    </div>-->

  </div>


</div>
<script type="text/javascript">

  /* hashtag list serach start*/
 
         $("#location_search").click(function(){
          var location = $('#location').val();

          $.ajax({
           url: "{{url('location-list-search')}}",
           type: "post",
           data: {"_token": "{{ csrf_token() }}","location":location},
           beforeSend: function(){
            // Show image container
            console.log(location);
            $("#Load").show();
           },
           success: function(response){
            console.log(response.data);
            if(response.data == 1){
              $('#exception_msg').html(response.insta_credential_err);
            }else if(response.data == 2){
              $('#exception_msg').html(response.location_err);
            }
            else{
              $('#page-content-wrapper').html(response);
            }
           },
           complete:function(data){
            // Hide image container
            $("#Load").hide();
           }
          });
         
         });

        /* hashtag list serach end*/

  /* hashtag list serach save start*/
 
         $("#ajax_locatiion_save").click(function(){
          // var hashtag_list = $('#hashtag_list').val();
          var location_list = $("input[name='location_list']:checked"). val();

          $.ajax({
           url: "{{url('location-list-search-save')}}",
           type: "post",
           data: {"_token": "{{ csrf_token() }}","location_list":location_list},
           beforeSend: function(){
            // Show image container
            console.log(location_list);
            $("#Load").show();
           },
           success: function(response){
            $("#Load").hide();
            $("#hashtag_session_save").show();
            $("#hashtag_session_save").html(response.data);
            // $('#page-content-wrapper').html(response);
            // Session["message"]=response.data;
            // window.location = "{{URL::to('create-destination')}}";
           },
           complete:function(data){
            // Hide image container
            $("#Load").hide();
           }
          });
         
         });

        /* hashtag list serach save end*/

</script>

<style type="text/css">


.load__none {
  display: none;  
  color:#fff;
}

.load__animation{
  border: 5px solid #06af94;
  border-top-color: #e50914;
  border-top-style: groove;
  height: 100px;
  width: 100px;
  border-radius: 100%;
  position: relative;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1000;
  margin: auto;
  -webkit-animation: turn 1.5s linear infinite;
  -o-animation: turn 1.5s linear infinite;
  animation: turn 1.5s linear infinite;
}

.load {
  position: fixed;
  background: url('assets/img/preloader.png') no-repeat 50% fixed / cover;);
  width: 100%;
  height: 100vh;
  top: 0px;
  left: 0px;
  right: 0px;
  opacity: 0.8;
  display: flex;
  align-items:center;
  justify-content: center;
  z-index: 999;
}

.load__container {
  position: relative;
}

@keyframes turn {
  from {transform: rotate(0deg)}
  to {transform: rotate(360deg)}
} 

.load__title {
  color: #fff;
  font-size: 2rem;
}


@keyframes loadPage {
  0% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }
  100% {
    opacity: 1;
  }
  
}
</style>