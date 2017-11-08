@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
	<div class="col-md-10">
	 <form class="form-horizontal" role="form" enctype="multipart/form-data" action="/profile" method="POST">
        <div class="col-md-4">
			<div class="form-group">
			<div class="col-md-12 text-center">
				<a href="#" class="image-avatar-upload">
					<img id="show-avatar-image" type="image" class="image-avatar-upload" data-userid="{{ md5(uniqid($user->id, true)) }}" src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; border-radius:50%;"/>
				</a>
			</div>
			</div>
			<div class="form-group">
			<div class="col-md-12 text-center">
				<a href="#" class="image-avatar-upload btn btn-primary" role="button">Upload</a>
			</div>
			</div>
			<input id="avatar-file-upload" type="file" name="avatar" style="display:none;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
		<div class="col-md-6">
			<div class="panel no-background panel-default">
					<div class="panel-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ $user->password }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</form>
    </div>
	</div>
</div>
<script>

</script>
@endsection