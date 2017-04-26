@extends('main')
@section('title','| Group Lists')

@section('content')
<div class='well well-lg text-center'>
	<h2>Takip Ettiğiniz Gruplar</h2>
</div>
<div class="container">
<div class='row'>
	<div class='col-md-12'>
		<form action='GroupSales' method='post'>
			{!! csrf_field() !!}
			<div class='table-responsive'>
				<table class='table table-bordered'>
					 <tr>
					 <th><input type='checkbox' id='Check'></th>
					 <th>ID</th>
					 <th>Groups</th>
					 </tr>
					 @foreach($groups as $group)
					 <tr>
					  <td><input type='checkbox' name='selected_group_ids[]' value='{{$group->id}}'></td>
					  <td>{{$group->id}}</td>
					  <td>{{$group->name}}</td>
					 </tr>
					 @endforeach
				</table>
			</div>
			<input class='btn btn-primary btn-block' type='submit' value='Satışları Listele'>
		</form>
	</div>
</div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
	$("#Check").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
	});
});
</script>
@endsection


