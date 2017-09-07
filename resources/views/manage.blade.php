@extends('Master.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="dashboard">
            @if (count($n_members))
                <div class="panel panel-default">
                    <!--<button class="btn btn-success " style="float:right; margin:3px 10px">保存</button>-->
                    <div class="panel-heading">
                        <a data-toggle="collapse" href="#collapse1">
                                                有新会员申请加入
                        </a>
                        <span class="badge">{{ sizeof($n_members) }}</span>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">

                        {!! Form::open(['url'=>'/adminManagement/members/confirm/', 'id'=>'member']) !!}
                        <input type="hidden" value="" name="id" id="mid" />
                        <input type="hidden" value="" name="rm" id="rm" />
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
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
                                <th></th>
                            </tr>
                            <?php $num = 0; ?>
                            @foreach($n_members as $m)
                            <tr>
                                <td>{{ ++$num }}</td>
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
                                <td>
                                    <input type="hidden" value="{{ $m->id }}" class="mid" />
                                    <button class="btn btn-primary huiyuan" >确认</button>
                                    <input type="submit" class="btn btn-danger huiyuan_rm" name="" value="删除" />
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        {!! Form::close() !!}
                    </div>
                </div>
            @endif
            <!-- rolling images section -->
            <div class="panel panel-default">
                <!--<button class="btn btn-success " style="float:right; margin:3px 10px">保存</button>-->
                <div class="panel-heading">滚动图片</div>

                <div class="panel-body">

                {!! Form::open(['url' => '/upload_rolling', 'files' => true]) !!}
                @if (!empty($rolling))
                    @foreach ($rolling as $r)

                        <div class="rolling-img">
                            <input type="hidden" name="id[]" value="{{ $r->id }}" />
                            <div class="switch">
                                    <input id="cmn-toggle-{{ $r->displayOrder }}" class="cmn-toggle cmn-toggle-round display" type="checkbox" name="display_{{ $r->displayOrder }}" {{ $r->display==1?'checked':'' }}>
                                    <label for="cmn-toggle-{{ $r->displayOrder }}"></label>
                            </div>
                            <div class="image-demo">
                                <img src="\img\{{ $r->imgURI }}" width="160" height="80" />
                            </div>
                            <div class="image-right-up">
                                <input type="text" value="{{ $r->link }}" name="link[]" class="form-control col-xs-6" Placeholder="输入链接网址" />

                            </div>
                            <div class="image-right-down">
                                <input type="file" name="rolling[]" class="form-control img-change" accept=".jpg,.gif,.JPEG,.PNG" title="点击更换图片" />
                            </div>
                        </div>

                    @endforeach

                    <div class="rolling-img">
                        <button class="btn btn-primary">保存</button>
                    </div>

                    @if (count($errors))
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                @foreach($errors->all() as $error)

                                    <li>{{ $error }} </li>

                                @endforeach
                                </ul>
                            </div>
                    @endif

                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-tick"></span>
                            <em> {!! session('flash_message') !!}</em>
                        </div>
                    @endif

                @else

                @endif

                {!! Form::close() !!}

                </div>
            </div>

            <!-- classified section -->

            <!--travel -->
            <div class="panel panel-default">
                <div class="panel-heading">旅游</div>
                <div class="panel-body">
                    @if (count($errors->travel))
                                    <div class="alert alert-danger " role="alert">
                                        <ul>
                                            @foreach($errors->travel->all() as $error)

                                                <li> {{ $error }} </li>

                                            @endforeach
                                        </ul>
                                    </div>
                    @endif
                    @if(Session::has('travel_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-tick"></span>
                            <em> {!! session('travel_message') !!}</em>
                        </div>
                    @endif
                    <ul class="card-list">
                        @if (!empty($travel))
                            @foreach ($travel as $t)
                                <li class="card">
                                    {!! Form::open(['url' => '/upload_card', 'files' => true]) !!}
                                    <div class="display-option">
                                        <div class="switch float-left">
                                            <input id="cmn-toggle-{{ $t->id }}" class="cmn-toggle cmn-toggle-round display" type="checkbox" name="display" {{ $t->display==1?'checked':'' }}>
                                            <label for="cmn-toggle-{{ $t->id }}"></label>
                                        </div>
                                        <span class="if-display-card"> {{ ($t->display?"":"不" ). "显示此卡片" }}</span>
                                    </div>
                                     <h5>点击图片更换</h5>


                                    <div class="add-photo">
                                        <img src="/img/travel/{{ $t->imgURI }}" width="200" height="200" />
                                    </div>
                                    <div class="card-text">

                                            <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                            <input value="travel" type="hidden" name="types" />
                                            <input value="{{ $t->id }}" type="hidden" name="id" />
                                            <input type="text" class="form-control" value="{{ $t->title }}" name="title" Placeholder="输入标题" />
                                            <input type="text" class="form-control" value="{{ $t->link }}" name="link" Placeholder="输入网址链接" />
                                            <textarea class="form-control" name="text" Placeholder="输入文字">{{ $t->text }}</textarea>
                                            <button class="btn btn-primary form-control">保存</button>

                                    </div>
                                    {!! Form::close() !!}
                                </li>
                            @endforeach
                        @endif
                        <li class="card">
                            <div class="display-option">

                            </div>
                            <h5>点击图片更换</h5>
                            <div class="add-photo">
                                <img src="/img/file-upload-icon.png" width="200" height="200" />
                            </div>
                            <div class="card-text">
                                {!! Form::open(['url' => '/add_card', 'files' => true]) !!}
                                    <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                    <input value="travel" type="hidden" name="types" />
                                    <input type="text" class="form-control" value="" name="title" Placeholder="输入标题" />
                                    <input type="text" class="form-control" value="" name="link" Placeholder="输入网址链接" />
                                    <textarea class="form-control" name="text" Placeholder="输入文字">{{ old('text') }}</textarea>
                                    <button class="btn btn-success form-control">添加卡片</button>
                                {!! Form::close() !!}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end travel -->
            <!-- property -->
            <div class="panel panel-default">
                <div class="panel-heading">地产</div>

                <div class="panel-body">
                    @if (count($errors->property))
                                    <div class="alert alert-danger " role="alert">
                                        <ul>
                                        @foreach($errors->property->all() as $error)

                                            <li> {{ $error }} </li>

                                        @endforeach
                                        </ul>
                                    </div>
                    @endif
                    @if(Session::has('property_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-tick"></span>
                            <em> {!! session('property_message') !!}</em>
                        </div>
                    @endif
                    <ul class="card-list">
                        @if (!empty($property))
                            @foreach ($property as $p)
                                <li class="card">
                                    {!! Form::open(['url' => '/upload_card', 'files' => true]) !!}
                                    <div class="display-option">
                                        <div class="switch float-left">
                                            <input id="cmn-toggle-{{ $p->id }}" class="cmn-toggle cmn-toggle-round display" type="checkbox" name="display" {{ $p->display==1?'checked':'' }}>
                                            <label for="cmn-toggle-{{ $p->id }}"></label>
                                        </div>
                                        <span class="if-display-card">{{ ($p->display?"":"不" ). "显示此卡片"}}</span>
                                    </div>
                                    <h5>点击图片更换</h5>
                                    <div class="add-photo">
                                        <img src="/img/property/{{ $p->imgURI }}" width="200" height="200" />
                                    </div>
                                    <div class="card-text">

                                            <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                            <input value="property" type="hidden" name="types" />
                                            <input value="{{ $p->id }}" type="hidden" name="id" />
                                            <input type="text" class="form-control" value="{{ $p->title }}" name="title" Placeholder="输入标题" />
                                            <input type="text" class="form-control" value="{{ $p->link }}" name="link" Placeholder="输入网址链接" />
                                            <textarea class="form-control" name="text" Placeholder="输入文字">{{ $p->text }}</textarea>
                                            <button class="btn btn-primary form-control">保存</button>

                                    </div>
                                    {!! Form::close() !!}
                                </li>
                            @endforeach
                        @endif
                        <li class="card">
                            <div class="display-option">

                            </div>
                            <h5>点击图片更换</h5>
                            <div class="add-photo">
                                <img src="/img/file-upload-icon.png" width="200" height="200" />
                            </div>
                            <div class="card-text">
                                {!! Form::open(['url' => '/add_card', 'files' => true]) !!}
                                    <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                    <input value="property" type="hidden" name="types" />
                                    <input type="text" class="form-control" value="" name="title" Placeholder="输入标题" />
                                    <input type="text" class="form-control" value="" name="link" Placeholder="输入网址链接" />
                                    <textarea class="form-control" name="text" Placeholder="输入文字">{{ old('text') }}</textarea>
                                    <button class="btn btn-success form-control">添加卡片</button>
                                {!! Form::close() !!}

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end property -->
            <!-- education -->
            <div class="panel panel-default">
                <div class="panel-heading">留学</div>
                <div class="panel-body">
                @if (count($errors->education))
                                    <div class="alert alert-danger " role="alert">
                                        <ul>
                                        @foreach($errors->education->all() as $error)

                                            <li> {{ $error }} </li>

                                        @endforeach
                                        </ul>
                                    </div>
                    @endif
                    @if(Session::has('education_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-tick"></span>
                            <em> {!! session('education_message') !!}</em>
                        </div>
                    @endif
                    <ul class="card-list">
                        @if (!empty($education))
                            @foreach ($education as $e)
                                <li class="card">
                                    {!! Form::open(['url' => '/upload_card', 'files' => true]) !!}
                                    <div class="display-option">
                                        <div class="switch float-left">
                                            <input id="cmn-toggle-{{ $e->id }}" class="cmn-toggle cmn-toggle-round display" type="checkbox" name="display" {{ $e->display==1?'checked':'' }}>
                                            <label for="cmn-toggle-{{ $e->id }}"></label>
                                        </div>
                                        <span class="if-display-card"> {{ ($e->display?"":"不" ). "显示此卡片" }}</span>
                                    </div>
                                    <h5>点击图片更换</h5>
                                    <div class="add-photo">
                                        <img src="/img/education/{{ $e->imgURI }}" width="200" height="200" />
                                    </div>
                                    <div class="card-text">

                                            <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                            <input value="education" type="hidden" name="types" />
                                            <input value="{{ $e->id }}" type="hidden" name="id" />
                                            <input type="text" class="form-control" value="{{ $e->title }}" name="title" Placeholder="输入标题" />
                                            <input type="text" class="form-control" value="{{ $e->link }}" name="link" Placeholder="输入网址链接" />
                                            <textarea class="form-control" name="text" Placeholder="输入文字">{{ $e->text }}</textarea>
                                            <button class="btn btn-primary form-control">保存</button>

                                    </div>
                                    {!! Form::close() !!}
                                </li>
                            @endforeach
                        @endif
                        <li class="card">
                            <div class="display-option">


                            </div>
                            <h5>点击图片更换</h5>
                            <div class="add-photo">
                                <img src="/img/file-upload-icon.png" width="200" height="200" />
                            </div>
                            <div class="card-text">
                                {!! Form::open(['url' => '/add_card', 'files' => true]) !!}
                                    <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                    <input value="education" type="hidden" name="types" />
                                    <input type="text" class="form-control" value="" name="title" Placeholder="输入标题" />
                                    <input type="text" class="form-control" value="" name="link" Placeholder="输入网址链接" />
                                    <textarea class="form-control" name="text" Placeholder="输入文字"></textarea>
                                    <button class="btn btn-success form-control">添加卡片</button>
                                {!! Form::close() !!}

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end education -->

            <!-- media -->
            <div class="panel panel-default">
                <div class="panel-heading">媒体</div>
                <div class="panel-body">
                @if (count($errors->media))
                                    <div class="alert alert-danger " role="alert">
                                        <ul>
                                        @foreach($errors->media->all() as $error)

                                            <li> {{ $error }} </li>

                                        @endforeach
                                        </ul>
                                    </div>
                    @endif
                    @if(Session::has('media_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-tick"></span>
                            <em> {!! session('media_message') !!}</em>
                        </div>
                    @endif
                    <ul class="card-list">
                        @if (!empty($media))
                            @foreach ($media as $m)
                                <li class="card">
                                    {!! Form::open(['url' => '/upload_card', 'files' => true]) !!}
                                    <div class="display-option">
                                        <div class="switch float-left">
                                            <input id="cmn-toggle-{{ $m->id }}" class="cmn-toggle cmn-toggle-round display" type="checkbox" name="display" {{ $m->display==1?'checked':'' }}>
                                            <label for="cmn-toggle-{{ $m->id }}"></label>
                                        </div>
                                        <span class="if-display-card"> {{ ($m->display?"":"不" ). "显示此卡片" }}</span>
                                    </div>
                                    <h5>点击图片更换</h5>
                                    <div class="add-photo">
                                        <img src="/img/media/{{ $m->imgURI }}" width="200" height="200" />
                                    </div>
                                    <div class="card-text">

                                            <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                            <input value="media" type="hidden" name="types" />
                                            <input value="{{ $m->id }}" type="hidden" name="id" />
                                            <input type="text" class="form-control" value="{{ $m->title }}" name="title" Placeholder="输入标题" />
                                            <input type="text" class="form-control" value="{{ $m->link }}" name="link" Placeholder="输入网址链接" />
                                            <textarea class="form-control" name="text" Placeholder="输入文字">{{ $m->text }}</textarea>
                                            <button class="btn btn-primary form-control">保存</button>

                                    </div>
                                    {!! Form::close() !!}
                                </li>
                            @endforeach
                        @endif
                        <li class="card">
                            <div class="display-option">


                            </div>
                            <h5>点击图片更换</h5>
                            <div class="add-photo">
                                <img src="/img/file-upload-icon.png" width="200" height="200" />
                            </div>
                            <div class="card-text">
                                {!! Form::open(['url' => '/add_card', 'files' => true]) !!}
                                    <input class="disappear img-change-2" value="" type="file" name="imgURI" />
                                    <input value="media" type="hidden" name="types" />
                                    <input type="text" class="form-control" value="" name="title" Placeholder="输入标题" />
                                    <input type="text" class="form-control" value="" name="link" Placeholder="输入网址链接" />
                                    <textarea class="form-control" name="text" Placeholder="输入文字"></textarea>
                                    <button class="btn btn-success form-control">添加卡片</button>
                                {!! Form::close() !!}

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end media -->
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.display').click(function() {
                console.log($(this).prop('checked'));
                if ($(this).prop('checked')==true){
                    $(this).parent().next(".if-display-card").text('显示此卡片');
                }
                else{
                    $(this).parent().next(".if-display-card").text('不显示此卡片');
                }


            });

            $(".add-photo").click(function() {
                $(this).next().find('.disappear').click();
            });

            $(".huiyuan").click(function(ev){
                ev.preventDefault();
                var id_val = $(this).prev('.mid').val();
                $("#mid").val(id_val);
                $("#rm").val('');
                $("form#member").submit();
            });

            $(".huiyuan_rm").click(function(ev){
                ev.preventDefault();
                var id_val = $(this).prev().prev('.mid').val();
                $("#mid").val(id_val);
                $("#rm").val("yes");
                if (confirm('真的要删除这个会员吗？')){
                  $("form#member").submit();
                }
            });

        });
    </script>
    <script src="/js/imagePreview.js" type="text/javascript"></script>
@endsection
