use Illuminate\Support\Facades\Auth;
@extends('layouts.frontend.app')

@section('title', 'Tag')


@section('css')
@parent
    <link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite_posts{
            color: blue;
        }
    </style>
@endsection

@section('content')
<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{$tag->name}}</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">
                @if($posts->count() > 0)
                @foreach($posts as $post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{asset('storage/post/'.$post->image)}}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="{{asset('storage/post/'.$post->image)}}" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{$post->title}}</b></a></h4>

								<ul class="post-footer">
									<li>
										@guest
											<a href="javascript:void(0);" onclick="toastr.info('You need to login', 'Info')"><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>
										@else
											<a class="{{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? 'favorite_posts' : ''}}"
											href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit()"><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>
											<form id="favorite-form-{{$post->id}}" style="display:none;" method="POST" action="{{route('post.favorite', $post->id)}}">
												@csrf
												
											</form>
										@endguest
										
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
                @endforeach
                @else
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">
							<div class="blog-info">
								<h4 class="title">
                                    Sorry, no post found.
                                </h4>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
                @endif
			</div><!-- row -->

			{{$posts->links()}}

		</div><!-- container -->
	</section><!-- section -->
@endsection

@section('js')
@parent

@endsection