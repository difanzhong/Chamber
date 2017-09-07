@extends('Master.layout', ['title'=>'商会活动', 'nav'=>2])

@section('content')

	<div class="event">
		@if (!empty($blog))
			<?php $b = $blog; ?>
		<div class="content-title">
			<h3 class="title">{{ $b->title }}</h3>
		</div>
			<div class="blog-content">
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

				<div class="blog-content-text">
					<?php
						$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
 						$allowedTags.='<li><ol><ul><span><div><br><ins><del>';
 					?>
 					{!! $b->content !!}
					{{-- htmlentities(htmlentities($b->content, ENT_COMPAT, 'UTF-8')) --}}
				</div>
			</div>
		@else
			<p>没有找到文章</p>
		@endif
	</div>
@endsection
