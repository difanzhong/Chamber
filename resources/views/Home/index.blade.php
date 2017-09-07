@extends('Master.layout', ['title'=>'后起之秀-澳大利亚上海企业家联合会', 'nav'=>1])

@section('content')
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
		  <!-- Indicators -->
		<ol class="carousel-indicators">
			@if (!empty($rolling))
				@for ($i=0; $i < count($rolling); $i++)
					<li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i==0?'active':'' }}"></li>
				@endfor
			@else
				{{ abort(404, "data not found") }}
			@endif
		</ol>

		  <!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox" >
			@if (!empty($rolling))
				@foreach ($rolling as $k => $r)
				    <div class="item {{ $k==0?'active':'' }}" >
				    	<a href="{{ $r->link }}"  target="_blank">
				    		<img src="/img/{{ $r->imgURI }}" alt="...">
				    	</a>
					    <div class="carousel-caption">

					    </div>
					</div>
				@endforeach
		    @else
				{{ abort(404, "data not found") }}
			@endif
		</div>
	</div>

	<div class="business-sec">
		<!-- Nav tabs -->
	    <ul class="nav nav-tabs classify-bar" role="tablist" style="font-weight: 200;">
		    <li role="presentation" class="active">
		    	<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
		    		<span class="glyphicon glyphicon-plane"></span>旅游
		    	</a>
		    </li>
		    <li role="presentation">
		    	<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
		    		<span class="glyphicon glyphicon-home"></span>地产
		    	</a>
		    	</li>
		    <li role="presentation">
		    	<a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
		    		<span class="glyphicon glyphicon-education"></span>留学
		    	</a>
		    </li>
		    <li role="presentation">
					<a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
						<span class="glyphicon glyphicon-eye-open"></span>媒体
					</a>
				</li>
  		</ul>

		<!-- Tab panes -->
	    <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="home">
		    	<ul class="card-list">
		    		@if (!empty($travel))
		    			@foreach($travel as $t)
				    		<li class="card">
				    			<img src="/img/travel/{{ $t->imgURI }}" width="200" height="200" />
				    			<div class="card-text">
				    				<h4 class="card-title"><a href="{{ $t->link }}">{{ $t->title }}</a></h4>
				    				<p class="card-content">{{ $t->text }}</p>
				    			</div>
				    		</li>
				    	@endforeach
		    		@endif
		    	</ul>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="profile">
		    	<ul class="card-list">
		    		@if (!empty($property))
		    			@foreach($property as $p)
				    		<li class="card">
				    			<img src="/img/property/{{ $p->imgURI }}" width="200" height="200" />
				    			<div class="card-text">
				    				<h4 class="card-title"><a href="{{ $p->link }}">{{ $p->title }}</a></h4>
				    				<p class="card-content">{{ $p->text }}</p>
				    			</div>
				    		</li>
				    	@endforeach
		    		@endif
		    	</ul>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="messages">
		    	<ul class="card-list">
		    		@if (!empty($education))
		    			@foreach($education as $e)
				    		<li class="card">
				    			<img src="/img/education/{{ $e->imgURI }}" width="200" height="200" />
				    			<div class="card-text">
				    				<h4 class="card-title"><a href="{{ $e->link }}">{{ $e->title }}</a></h4>
				    				<p class="card-content">{{ $e->text }}</p>
				    			</div>
				    		</li>
				    	@endforeach
		    		@endif
		    	</ul>
		    </div>
				<div role="tabpanel" class="tab-pane" id="settings">
		    	<ul class="card-list">
		    		@if (!empty($media))
		    			@foreach($media as $m)
				    		<li class="card">
				    			<img src="/img/media/{{ $m->imgURI }}" width="200" height="200" />
				    			<div class="card-text">
				    				<h4 class="card-title"><a href="{{ $m->link }}">{{ $m->title }}</a></h4>
				    				<p class="card-content">{{ $m->text }}</p>
				    			</div>
				    		</li>
				    	@endforeach
		    		@endif
		    	</ul>
		    </div>
	    </div>
	</div>

@endsection

@section('footer')
	<script>
		$(document).ready(function(){
			$('.carousel').carousel({
			  interval: 10000
			});

			$('#myTabs a').click(function (e) {
			  e.preventDefault();
			  $(this).tab('show');
			});
		})
	</script>
@endsection
