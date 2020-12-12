@extends('layouts.main')


@section('content')

<form style="margin-left: 50%"  class="was-validated" action="{{ url('admin/post/'.$post->id.'/update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title"  value="{{ $post->title }}" required autocomplete="title">
        <div class="invalid-feedback">Title</div>
    </div>
    <div class="form-group">
        <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Slug"  value="{{ $post->slug }}" required autocomplete="slug">
        <div class="invalid-feedback">Title</div>
    </div>

    <div class="mb-3">
        <label for="validationTextarea">Textarea</label>
        <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="validationTextarea" placeholder="Required example textarea" required>{!! $post->body !!}</textarea>
        <div class="invalid-feedback">
            Please enter a Post Body in the textarea.
        </div>
    </div>
    <div class="form-group">
        <select name="category" class="custom-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Select Category</div>
    </div>

    <div class="custom-file">
        <input value="{{ old('thumbnail') }}" name="thumbnail" type="file" accept="image/png, image/jpeg, image/jpg" class="custom-file-input" id="validatedCustomFile" >
        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    </div>

    <button class="btn btn-primary" style="margin-top: 20px" type="submit">Update</button>
</form>


@endsection
