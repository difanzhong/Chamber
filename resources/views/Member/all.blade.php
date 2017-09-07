@extends('Master.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-striped">
				<tr>
					<th>姓名</th>
					<th>生日</th>
					<th>英文名</th>
					<th>昵称</th>
					<th>国籍</th>
					<th>行业</th>
					<th>出生地</th>
					<th>常住地</th>
					<th>手机</th>
					<th>微信</th>
					<th>邮箱</th>
				</tr>
				@foreach($members as $m)
					<tr>
						<td>{{ $m->name }}
							<ul class="invisible-info list-group">
								<li class="list-group-item">拼音：{{ $m->pinyin }}</li>
								@if (!empty($m->n_name))
									<li class="list-group-item">昵称：{{ $m->n_name }}</li>
								@endif
								@if (!empty($m->contact))
									<li class="list-group-item">电话：{{ $m->contact }}</li>
								@endif
								@if (!empty($m->o_nationality))
									<li class="list-group-item">原籍：{{ $m->o_nationality }}</li>
								@endif
								@if (!empty($m->hobby))
									<li class="list-group-item">个人爱好：{{ $m->hobby }}</li>
								@endif
								@if (!empty($m->findus))
									<li class="list-group-item">了解我们的途径：{{ $m->findus }}</li>
								@endif
							</ul>
						</td>
						<td>{{ $m->birthday }}</td>
						<td>{{ $m->e_name }}</td>
						<td>{{ $m->n_name }}</td>
						<td>{{ $m->c_nationality }}</td>
						<td>{{ $m->occupation }}</td>
						<td>{{ $m->birth_place }}</td>
						<td>{{ $m->address }}</td>
						<td>{{ $m->mobile }}</td>
						<td>{{ $m->wechat }}</td>
						<td>{{ $m->email }}</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@endsection
