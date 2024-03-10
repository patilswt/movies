@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
      <div class="row justify-content-center">
        <ul class="list-group">

		


		  	@foreach($notifications as $nofication)

			@if(empty($nofication['read_at']))
			<li class="list-group-item list-group-item-action active" onclick="markasreadNotification(this);" data-id="{{$nofication['id']}}">
  			@else
  			<li class="list-group-item list-group-item-action" id="markasread" data-id="{{$nofication['id']}}">
			@endif

  			<a href="/user/movie/{{$nofication['data']['notification']['movieId']}}" aria-current="true" style="text-decoration: none !important; color:inherit;">
  			<!-- <a href="/movie/{{$nofication['data']['notification']['movieId']}}" aria-current="true"> -->
      			<div class="row justify-content-center">
					<div class="col-md-4" style="background-image: url(
'{{url('/images')}}/{{$nofication['data']['notification']['movie_image_path']}}');height: 120px; background-position: top; background-repeat: no-repeat; background-size: cover;">
					</div>
					<div class="col-md-8">
    					<div class="d-flex w-100 justify-content-between">
      						<h5 class="mb-1">{{$nofication['data']['notification']['message']}}</h5>

      						@if(date_diff(new \DateTime($nofication['data']['notification']['created_at']),new \DateTime(date('Y-m-d H:i:s')))->format("%d") > 0)
								<small>{{date_diff(new \DateTime($nofication['data']['notification']['created_at']),new \DateTime(date('Y-m-d H:i:s')))->format("%d days")}} ago</small>
							@else	
								<small>{{date_diff(new \DateTime($nofication['data']['notification']['created_at']),new \DateTime(date('Y-m-d H:i:s')))->format("%H hrs %i min %s sec")}} ago</small>
   							@endif
    					</div>
    					<p class="mb-1">{{$nofication['data']['notification']['title']}}</p>
    					<p class="mb-1">{{ substr($nofication['data']['notification']['description'],0,100) }} ...</p>
    					<small>Publication Date {{date('d-m-Y',strtotime($nofication['data']['notification']['publication_date']))}}</small>
					</div>
				</div>
  			</a>
  			  </li>
			@endforeach

		  
		</ul>
        
    </div>
    </div>
    </div>
</div>
<script type="text/javascript">
 
        

    function markasreadNotification(ele){ 
    $id = $(ele).data("id");
               $.ajax({
        url: "/user/movie_notification_markasread/"+$id,
        type: 'GET',
        success: function(res) {
            // console.log(res);
          
        }
    });
            
    }
 </script>

@endsection
 