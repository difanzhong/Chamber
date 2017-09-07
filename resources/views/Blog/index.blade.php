@extends('Master.app')

@section('content')
	<div class="container">
    	<div class="row">
        	<div class="dashboard">
        		<div class="panel panel-default ">
                	<div class="panel-heading">活动列表</div>

                	<div class="panel-body">
                		@if (count($blogs))
                			<ul class="show-blogs">
                			@foreach($blogs as $b)
                				<li class="blog-abstract">

                					<div class="b-thumb" style="background: url( {{ asset('/img/event/' . (empty($b->thumbnail)?'event.png' : $b->thumbnail)) }} ) no-repeat center">
                					</div>
                					<div class="blog-info">
                						<h2 class='blog-title'>{{ $b->title }}</h2>
                						<div class="blog-venue">
                							<span class="">地点-</span>
                							{{ $b->venue }}
                						</div>
                						<div class="blog-date">
                							<span class="">时间-</span>
                							{{ (new Datetime($b->event_date))->format('Y年m月d日') }}
                						</div>
                						<div class="form-group margin-top-10">
                							<a class="btn btn-primary" href="/adminManagement/blog/update/{{ $b->id }}">编辑</a> <br />
                							<span>创建时间： {{ (new Datetime($b->created_at))->format('Y年m月d日 H时i分s秒') }}</span><br />
                                            <span>最近更改： {{ (new Datetime($b->updated_at))->format('Y年m月d日 H时i分s秒') }}</span>
                						</div>
                					</div>
                					
                				</li>
                			@endforeach
                			</ul>
                		@endif 
                	</div>
            	</div>
            </div>
        </div>
    </div>

@endsection