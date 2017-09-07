@extends('Master.app')
@section('upper_additional_script')
	<link rel="stylesheet" href="/jquery-ui/jquery-ui.min.css" />
@endsection
@section('content')
	@section('content')
	<div class="container">
    	<div class="row">
        	<div class="dashboard">
        		<div class="panel panel-default ">
                <!--<button class="btn btn-success " style="float:right; margin:3px 10px">保存</button>-->
                	<div class="panel-heading">创建活动</div>

                	<div class="panel-body">

                		<!-- error message -->
                		@if (count($errors))
                            <div class="alert alert-danger " role="alert">
                                <ul>
	                                @foreach($errors->all() as $error)
	                                    
	                                    <li> {{ $error }} </li>
	                                    
	                                @endforeach
                                </ul>
                            </div>
	                    @endif
	                    @if(Session::has('success_message'))
	                        <div class="alert alert-success">
	                            <span class="glyphicon glyphicon-tick"></span>
	                            <em> {!! session('success_message') !!}</em>
	                        </div>
	                    @endif
                		<!-- end error message -->

                		<script src="/tinymce/tinymce.min.js"></script>
						<script>
							var editor_config = {
								path_absolute : "/",
								selector: "textarea#b_content",
								plugins: [
									"advlist autolink lists link image charmap print preview hr anchor pagebreak",
									"searchreplace wordcount visualblocks visualchars code fullscreen",
									"insertdatetime media nonbreaking save table contextmenu directionality",
									"emoticons template paste textcolor colorpicker textpattern"
									],
								toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
								relative_urls: false,
								file_browser_callback : function(field_name, url, type, win) {
									var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
									var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

									var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
									if (type == 'image') {
										cmsURL = cmsURL + "&type=Images";
									} else {
										cmsURL = cmsURL + "&type=Files";
									}

									console.log(cmsURL);

									tinyMCE.activeEditor.windowManager.open({
										file : cmsURL,
										title : 'Filemanager',
										width : x * 0.8,
										height : y * 0.8,
										resizable : "yes",
										close_previous : "no"
									});
								}
							};

  							tinymce.init(editor_config);
						</script>

						@if (count($blogs))
							<?php $b = $blogs[0]; ?>
						
						{!! Form::open(['url' => '/adminManagement/blog/store/update', 'files' => true ]) !!}
						<input type="hidden" value="{{ $b->id }}" name="id" />
						<div class="col-md-10">
							<div class="col-md-4 float-right blog-thumbnail">
								<div class="form-group">
									<label for="">点击更换图片</label>
									<input id="b_thumbnail" type="file" name="thumbnail" class="disappear" ) />
									<div class="ctn picture-click" style="background: url({{ asset('/img/event/' . (empty($b->thumbnail)?'event.png':$b->thumbnail) ) }}) no-repeat center"></div>
									<div class="blog-display">
										<div class="switch">
		                                    <input id="cmn-toggle-x" class="cmn-toggle cmn-toggle-round display" type="checkbox" name="display" {{ $b->display==1?'checked':'' }}>
		                                    <label for="cmn-toggle-x"></label>
	                            		</div>
	                            		<span class="if-display-card"> {{ ($b->display?"":"不" ). "显示这篇文章" }}</span>
                            		</div>
								</div>
							</div>
							<div class="form-group col-md-10">
								<label for="b_title">标题</label>
								<input id="b_title" type="text" name='title' value="{{ $b->title }}" class="form-control" placeholder="输入标题"/>
							</div>
							<div class="form-group col-md-5">
							    <label for="b_venue">地点</label>
							    <input type="text" class="form-control" value="{{ $b->venue }}" id="b_venue" name="venue" placeholder="输入地点" />
							</div>
							<div class="form-group col-md-5">
							    <label for="b_date">日期</label>
							    <input type="text" class="form-control" id="b_date" name="event_date" value="{{ $b->event_date }}" placeholder="输入日期" />
						 	</div>
						 	<div class="form-group col-md-10">
							    <label for="b_content">内容</label>
							    <textarea class="form-control" id="b_content" name="content" placeholder="输入内容">{{ $b->content }}</textarea>
						 	</div>
						 	
						 	<div class="form-group col-md-10">
							    <button class="btn btn-success form-control">确认更改</button>
						 	</div>
						</div>
						{!! Form::close() !!}
						@endif 
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="/jquery-ui/jquery-ui.min.js" ></script>
	<script>
		$(document).ready(function(){
			$('#b_date').datepicker();

			$('div.ctn').click(function() {
				$(this).prev().click();
			});

			$('.display').click(function() {
                console.log($(this).prop('checked'));
                if ($(this).prop('checked')==true){
                    $(this).parent().next(".if-display-card").text('显示这篇文章');
                }
                else{
                    $(this).parent().next(".if-display-card").text('不显示这篇文章');
                }
            });
		})
	</script>
	<script src="/js/imagePreview.js" type="text/javascript"></script>
@endsection