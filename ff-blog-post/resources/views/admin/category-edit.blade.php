@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <h1>Edit category</h1>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form role="form" method="post" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data" id="quickForm">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="title" value="{{ $category->title }}" class="form-control title" id="exampleInputEmail1" placeholder="Enter title">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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

        tinymce.init({
            selector: '.textarea'
        });

        bsCustomFileInput.init();
    </script>
@endsection


@section('plugins.Tinymce', true)
@section('plugins.BsCustomFileInput', true)
