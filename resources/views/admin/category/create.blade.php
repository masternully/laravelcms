@extends('layouts.backend.app')

@section('title', 'Category')

@section('css')
@parent

@endsection

@section('content')
<div class="container-fluid">
            <!-- #END# Vertical Layout -->
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW CATEGORY
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.category.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="email_address" class="form-control" name="name">
                                        <label class="form-label">Category Name</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="image">
                                </div>

                                <a class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}">Back</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Column -->
        </div>
@endsection

@section('js')
@parent

@endsection