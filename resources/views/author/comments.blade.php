@extends('layouts.backend.app')

@section('title', 'Comments')

@section('css')
@parent
<link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL COMMENTS
                            <span class="badge bg-blue"></span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th class="text-center">Comments Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th class="text-center">Comments Info</th>
                                    <th class="text-center">Post Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($posts as $key=>$post)
                                        @foreach($post->comments as $comment)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="{{asset('storage/profile/'.$comment->user->image)}}" width="64" height="64">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                        </h4>
                                                        <p>{{ $comment->comment }}</p>
                                                        <a target="_blank" href="{{ route('post.details',$comment->post->slug.'#comments') }}">Reply</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-right">
                                                        <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                                                            <img class="media-object" src="{{asset('storage/post/'.$comment->post->image)}}" width="64" height="64">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <a target="_blank" href="{{ route('post.details',$comment->post->slug) }}">
                                                            <h4 class="media-heading">{{ str_limit($comment->post->title,'40') }}</h4>
                                                        </a>
                                                        <p>by <strong>{{ $comment->post->user->name }}</strong></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger waves-effect" onclick="deleteComment({{ $comment->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ route('author.comment.destroy',$comment->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@section('js')
@parent
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script>
        function deleteComment(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            }
            })
        }
    </script>
@endsection