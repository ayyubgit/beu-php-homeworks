@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <h1>Add new blog post</h1>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form role="form" method="post" action="{{ route('admin.post.store') }}" enctype="multipart/form-data" id="quickForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="title" value="{{ old("title") }}" class="form-control title" id="exampleInputEmail1" placeholder="Enter title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slug</label>
                                    <input type="text" name="slug" value="{{ old("slug") }}" class="form-control" id="exampleInputPassword1" placeholder="Slug">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="customFile">Post Photo</label>

                                    <div class="custom-file">
                                        <input type="file" name="thumbnail" value="{{ old("photo") }}" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose photo</label>
                                    </div>
                                    @error('thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    @empty($categories)
                                        <a href="{{ route('admin.categories.create') }}" class="d-block mb-3 text-danger text-bold">No categories yet, create a category first</a>
                                    @endempty
                                    <label>Category</label>
                                    <select class="select2" name="category" data-placeholder="Select a Category" style="width: 100%;">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('categories')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <textarea class="textarea" placeholder="Place some text here" name="body"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old("content") }}</textarea>
                                    @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
    </section>
@stop

@section('js')
    <script>
        $('.select2').select2()

        tinymce.init({
            selector: '.textarea'
        });

        bsCustomFileInput.init();
    </script>
@endsection


@section('plugins.Select2', true)
@section('plugins.Tinymce', true)
@section('plugins.BsCustomFileInput', true)
