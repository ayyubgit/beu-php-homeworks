@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <h1>All Blogs</h1>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary text-white" href="{{route('admin.post.create')}}">
                                <i class="fas fa-plus-circle"></i>
                                <span>Create Post</span>
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $post)
                                <tr id="js-row-id-{{$post->id}}">
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->categories }}</td>
                                    <td class="text-center"><a href="{{route('admin.post.edit', $post->slug)}}"><i class="fas fa-edit"></i></a></td>
                                    <td class="text-center">
                                        <span class="js-delete-post-trigger"
                                              style="cursor: pointer"
                                              data-url="{{ route('admin.post.edit', $post->slug) }}"
                                              data-toggle="modal"
                                              data-target="#modal-danger"
                                        >
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                    No Posts yet
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-light js-delete-post">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('js')
    <script>
        const $table = $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $('.js-delete-post-trigger').on('click', function () {
            const url = $(this).data('url');

            $('.js-delete-post').data('url', url);
        })

        $('.js-delete-post').on('click', function () {
            const url = $(this).data('url');

            $.ajax(url, {
                method: 'delete',
                data: {
                    "_token": "{{csrf_token()}}"
                },
                success: (response) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Deleted sucessfully'
                    })

                    $table.row(`#js-row-id-${response.id}`)
                        .remove()
                        .draw();
                },
                error: (data) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'Server  Error, contact support'
                    })
                }
            })

            $(this).closest('.modal').modal('hide');
        })
    </script>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
