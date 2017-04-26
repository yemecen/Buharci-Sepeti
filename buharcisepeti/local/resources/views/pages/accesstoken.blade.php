@extends('main')
@section('title','| Access Token')
@section('message')

@if(Session::has('success'))
	
	<div class="alert alert-success" role="alert">
	Access Token Kaydedildi.Grupları Listeleyebilirsiniz
	</div>
@endif

@endsection

@section('content')
<div class="container">
    <div class='row'>
			<div class='col-md-12'>
				<form  action='AccessToken' method='post'/>
					{!! csrf_field() !!}
					<div class="form-group">
						<input class="form-control" type="text" name="accessToken" placeholder="Acccess Token">
					</div>
					<div class="form-group">
						<input class="btn btn-primary btn-block" type='submit' value='Access Token Kaydet'>
					</div>
				</form>
				<a class="btn btn-success btn-block" href="{{route('GroupLists.index')}}" role="button">Grupları Listele</a>
			
			</div>
		</div>
	</div>
@endsection