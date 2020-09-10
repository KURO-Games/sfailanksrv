@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">ログイン</div>
		<div class="card-body">

			@if ($errors->any())
			<div style="color:red;">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div>
			@endif

			<form method="post" action="{{ url('admin/login') }}">
			@csrf 
			<div>
				ID: <input class="form-control" type="text" name="user_id" value="" />
			</div>
			<div>
				PASS: <input class="form-control" type="password" name="password" value="" />
			</div>
			<div class="mt-3">
				<input class="btn btn-primary" type="submit" value="ログイン" />
			</div>
			</form>

		</div>
	</div>
</div>
@endsection
