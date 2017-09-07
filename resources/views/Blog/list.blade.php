@extends('Master.layout', ['title'=>'商会活动','nav'=>2])

@section('content')
	<h3 class="title">商会活动</h3>
	<div class="right-side">

	</div>
	<div class="left-side">

		<ul class="show-blogs">
			@foreach($blogs as $b)
				<li class="blog-abstract">

					<div class="b-thumb" style="background: url( {{ asset('/img/event/' . (empty($b->thumbnail)?'event.png' : $b->thumbnail)) }} ) no-repeat center">
					</div>
					<div class="blog-info">
						<div class="blog-info-top">
							<span class="blog-time">
								<!--
								@if (!empty($b->updated_at))
									更新于 {{ (new Datetime($b->updated_at))->format('Y年m月d日 H:i:s') }}
								@else
									发表于 {{ (new Datetime($b->created_at))->format('Y年m月d日 H:i:s') }}
								@endif
								-->
								<span class="glyphicon glyphicon-calendar"></span>
								{{ (new Datetime($b->event_date))->format('Y年m月d日') }}

							</span>
							<span class="blog-venue">
								<span class="glyphicon glyphicon-map-marker"></span>
								{{ $b->venue }}
							</span>
						</div>
						<a class="" href="/event/{{ $b->id }}"><h3 class='blog-title'>{{ $b->title }}</h3></a>
						{{-- <div class="blog-venue">
							<span class="">地点-</span>
							{{ $b->venue }}
						</div>
						<div class="blog-date">
							<span class="">时间-</span>
							{{ (new Datetime($b->event_date))->format('Y年m月d日') }}
						</div> --}}
						<p class="read-more">
							<a class="btn btn-link" style="margin-bottom:0px;padding-left:0;" href="/event/{{ $b->id }}">阅读更多内容</a>
						</p>
					</div>

				</li>
			@endforeach
		</ul>
	</div>
@endsection
