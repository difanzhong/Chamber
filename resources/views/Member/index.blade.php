@extends('Master.layout', ['title'=>'会员申请', 'nav'=>3])

@section('header')
	<link rel="stylesheet" href="/jquery-ui/jquery-ui.min.css" />
@endsection

@section('content')
	<h3 class="title">入会申请信息</h3>
	<div class="member-reg">

		@if(Session::has('success_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-tick"></span>
                            <em> {!! session('success_message') !!}</em>
                        </div>
                    @endif
		<div class="basic-info m-info">
			{!! Form::open(['url'=>'/member/store']) !!}

			<h4 class="title">基本信息</h4>
			<p class="small-info">*为必填项</p>

			<div class="form-group col-md-3 {{ $errors->has('name')?'has-error':'' }}">
				<label for="name" class="control-label"><span class="star">*</span>姓名</label>
				<input type="text"  name="name" value="{{ old('name') }}" class="form-control {{ $errors->has('name')?'has-error':'' }}" placeholder="输入姓名" />
			</div>
			<div class="form-group col-md-3 {{ $errors->has('pinyin')?'has-error':'' }}">
				<label for="pinyin" class="control-label"><span class="star">*</span>拼音</label>
				<input type="text" name="pinyin" value="{{ old('pinyin') }}" class="form-control" placeholder="输入姓名拼音" />
			</div>

			<div class="form-group col-md-3 {{ $errors->has('e_name')?'has-error':'' }}">
				<label for="e_name" class="control-label">英文名</label>
				<input type="text" name="e_name" value="{{ old('e_name') }}" class="form-control" placeholder="输入英文名" />
			</div>

			<div class="form-group col-md-3 {{ $errors->has('n_name')?'has-error':'' }}">
				<label for="n_name" class="control-label">昵称</label>
				<input type="text" name="n_name" value="{{ old('n_name') }}" class="form-control" placeholder="输入昵称" />
			</div>

			<div class="form-group col-md-3 {{ $errors->has('birthday')?'has-error':'' }}">
				<label for="birthday" class="control-label"><span class="star">*</span>生日</label>
				<input type="text" name="birthday" value="{{ old('birthday') }}" class="form-control" placeholder="输入出生日期" />
			</div>

			<div class="form-group col-md-3 {{ $errors->has('birth_place')?'has-error':'' }}">
				<label for="birth_place" class="control-label"><span class="star">*</span>出生地</label>
				<input type="text" name="birth_place" value="{{ old('birth_place') }}" class="form-control" placeholder="输入出生地" />
			</div>

			<div class="form-group col-md-3 {{ $errors->has('address')?'has-error':'' }} ">
				<label for="address" class="control-label"><span class="star">*</span>常住地</label>
				<input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="输入常住地" />
			</div>

			<div class="clear"></div>

			<div class="form-group col-md-3 {{ $errors->has('occupation')?'has-error':'' }}">
				<label for="occupation" class="control-label"><span class="star">*</span>行业</label>
				<input type="text" name="occupation" value="{{ old('occupation') }}" class="form-control" placeholder="输入行业" />
			</div>

			<div class="form-group col-md-3 {{ $errors->has('o_nationality')?'has-error':'' }}">
				<label for="o_nationality" class="control-label" ><span class="star">*</span>国籍</label>
				<input type="text" name="o_nationality" value="{{ old('o_nationality') }}" class="form-control" placeholder="输入国籍" />
			</div>

			<div class="form-group col-md-3 {{ $errors->has('c_nationality')?'has-error':'' }}">
				<label for="c_nationality" class="control-label">原籍</label>
				<input type="text" name="c_nationality" value="{{ old('c_nationality') }}" class="form-control" placeholder="输入原籍" />
			</div>



			<div class="clear"></div>

			<div class="form-group col-md-6 {{ $errors->has('findus')?'has-error':'' }}">
				<label for="findus" class="control-label"><span class="star">*</span>了解我们的途径</label>
				<input type="text" name="findus" value="{{ old('findus') }}" class="form-control" placeholder="" />
			</div>

			<div class="form-group col-md-6 {{ $errors->has('hobby')?'has-error':'' }}">
				<label for="hobby" class="control-label">个人爱好</label>
				<input type="text" name="hobby" value="{{ old('hobby') }}" class="form-control" placeholder="" />
			</div>

		</div>
		<div class="contact-info m-info">

			<h4 class="title">联系方式</h4>
			<p class="small-info">*为必填项</p>
			<div class="form-group col-md-3 {{ $errors->has('contact')?'has-error':'' }}">
				<label for="contact" class="control-label">电话</label>
				<input type="text" name="contact" value="{{ old('contact') }}" class="form-control" placeholder="输入电话" />
			</div>
			<div class="form-group col-md-3 {{ $errors->has('mobile')?'has-error':'' }}">
				<label for="mobile" class="control-label"><span class="star">*</span>手机</label>
				<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" placeholder="输入手机号码" />
			</div>
			<div class="form-group col-md-3 {{ $errors->has('email')?'has-error':'' }}">
				<label for="email" class="control-label"><span class="star">*</span>邮箱</label>
				<input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="输入邮箱" />
			</div>
			<div class="form-group col-md-3 {{ $errors->has('wechat')?'has-error':'' }}">
				<label for="wechat" class="control-label"><span class="star">*</span>微信</label>
				<input type="text" name="wechat" value="{{ old('wechat') }}"  class="form-control" placeholder="输入微信号" />
			</div>

		</div>
		<div class="m-info margin-top-10">
			<div class="form-group col-md-3">
				<button class="btn btn-primary btn-lg">提交信息</button>
			</div>
		</div>
		<div class='clear'></div>
		<div class="m-info">
			@if (count($errors))
                <div class="alert alert-danger" role="alert">
                    <ul>
	                    @foreach($errors->all() as $key=>$error)

	                        <li>{{ $error }} </li>

	                    @endforeach

	                    {{-- @foreach(array_keys($errors) as $key)

	                        <li>{{ $key }} </li>

	                    @endforeach --}}
                    </ul>
                </div>
        	@endif
		</div>
	</div>

@endsection

@section('footer')
	<script src="/jquery-ui/jquery-ui.min.js" ></script>
	<script>
		$(document).ready(function(){
			// $('input[name=wechat]').keyup(function(){
			// 	WeChat($(this));
			// });
			$('input[name=pinyin]').keyup(function(){
				noChinese($(this));
				//clipboardData.setData('text',clipboardData.getData('text').replace(/[^/u4E00-/u9FA5]/g,''))
			});
			$('input[name=e_name]').keyup(function(){
				noChinese($(this));
			});
			// $('input[name=wechat]').keyup(function(){
			// 	WeChat($(this));
			// });

			$('input[name=birthday]').datepicker({ changeMonth:true, changeYear:true,yearRange: "1930:2006",dateFormat:"yy-mm-dd", defaultDate: "1970-01-01"});
		});

		function noChinese(selector){
			var v = selector.val();
			v = v.replace(/[^\w\.\/\s]/ig,''); // no chinese
			selector.val(v);
		}
		function noChineseWithoutSpace(selector){
			var v = selector.val();
			v = v.replace(/[^\w\.\/]/ig,''); // no chinese
			selector.val(v);
		}
		// function WeChat(selector){
		// 	var v = selector.val();
		// 	v = v.replace(/^[a-zA-Z0-9_\-]{6,}$/ig,'');
		// 	selector.val(v);
		// }
	</script>

@endsection
