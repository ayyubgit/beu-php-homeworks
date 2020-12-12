@extends('layouts.main')


@section('content')


    <form  style="margin-left: 55%" action="{{ url('auth/register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input name="name" placeholder="Name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('name') }}" required autocomplete="email">
            @error('name')
            <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Surname</label>
            <input name="surname" placeholder="Surname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('surname') }}" required autocomplete="email">
            @error('surname')
            <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{ old('password') }}" required autocomplete="current-password">
            <input name="password_confirmation" type="password" class="form-control" style="margin-top: 10px" id="exampleInputPassword1" placeholder="Password" value="{{ old('password') }}" required autocomplete="current-password">
            @error('password')
            <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="custom-file">
            <input value="{{ old('thumbnail') }}" name="thumbnail" type="file" accept="image/png, image/jpeg, image/jpg" class="custom-file-input" id="validatedCustomFile" required>
            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
            <div class="invalid-feedback">Example invalid custom file feedback</div>
        </div>
        <button type="submit" style="margin-top: 20px" class="btn btn-primary">Submit</button>
    </form>

@endsection
