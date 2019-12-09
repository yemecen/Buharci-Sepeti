@extends('main')
@section('title','Buharcı Sepeti-Facebook Gruplarında ki Tüm Elektronik Sigara Satışları | buharcisepeti.com')

@section('content')
	<div class="container">
		<div class="row">
	        <div class="col-sm-6 col-sm-offset-3">
	            <div id="imaginary_container"> 
	            	<form  action='VapeSalesSearch' method='post'/>
	            	{!! csrf_field() !!}
	                <div class="input-group stylish-input-group input-group-lg">
	                    <input type="text" class="form-control" name="search"  
	                    	@if(isset($mark) && $mark==true)
		                    	@if(isset($equipment) && isset($city))
		                    		value="{{$equipment}} {{$city}}"
		                    	@else
		                    		value="{{$equipment}}"
		                    	@endif
	                    	@endif
	                    	 placeholder="Örn arama:Melo III veya Melo III #Ankara" >
	                    <span class="input-group-addon">
	                        <button type="submit">
	                            <span class="glyphicon glyphicon-search"></span>
	                        </button>  
	                    </span>
	                </div>
	                </form>
	            </div>
	        </div>
		</div>
	</div>

	<div class="container">	
	<div class="row">
		@foreach($sales as $sale)
		<div class="col-md-12">
			<div class="thumbnail">
				<img src="
				@if($sale->fullPicture=="-")
				img/noimage.jpg
				@else
				{{$sale->fullPicture}}
				@endif" alt="" class="responsive">
				<div class="caption">
					<h3></h3>
					<p>
						<b>İlan Oluşturulma ve Güncelleme zamanı: {{$sale->salesCreatedTime}} - {{$sale->salesUpdatedTime}}</b><br><br>
						{{$sale->message}}<br>
						<p>
						<a href="{{$sale->permalinkUrl}}" class='btn btn-primary btn-lg btn-block' target='_blank'>İncele</a>
						</p>
					</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>	
	</div>
@endsection
@section('script')
<script>
$(document).ready(function(){

    var $search = $("input[name='search']").val();

    $context = $(".container .row .col-md-12 .thumbnail .caption");

    $context.show().unmark();
		if ($search) {
			$context.mark($search, {
			done: function() {
			$context.not(":has(mark)").hide();
			}
		  });
		}
});
</script>
@endsection