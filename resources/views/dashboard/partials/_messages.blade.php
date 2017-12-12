@if (Session::has('success'))
	<div class="container-fluid">
		<div class="row">
	  	<div class="col-sm-10 col-sm-offset-1 alert alert-success text-center" role="alert" data-dismmiss="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
	    	<strong>{{ Session::get('success')}}</strong>
	  	</div>
		</div>
	</div>
@endif

@if(count($errors)>0)
	<div class="container-fluid">
		<div class="row">
	  	<div class="col-sm-10 col-sm-offset-1 alert alert-danger" role="alert" data-dismmiss="alert">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
	  		</ul>
		  		@foreach ($errors->all() as $error)
		    		<li><strong>{{ $error }}</strong></li>
		    	@endforeach
	    	</ul>
	  	</div>
		</div>
	</div>
@endif