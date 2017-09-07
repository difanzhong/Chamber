<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\HomePage;
use App\Blog;
use App\Member;
use Image;
use Validator;

class ManagementController extends Controller
{

	public function __construct()
    {
				
        $this->middleware('auth');
    }

    public function Index(){
    	$rolling = HomePage::where('type','滚动')->get();
        $property = HomePage::where('type','property')->get();
        $travel = HomePage::where('type','travel')->get();
        $education = HomePage::where('type','education')->get();
				$media = HomePage::where('type','media')->get();

        $unconfirmed_members = Member::where('confirm', false)->get();

    	return view('manage')
                ->with('rolling', $rolling)
                ->with('property',$property)
                ->with('travel', $travel)
                ->with('education',$education)
								->with('media', $media)
                ->with('n_members',$unconfirmed_members);
    }

    public function upload_rolling(Request $request){

        $error_msg = [];

        // check display pictures, at least one need to be displayed.
        $atLeastOneDisplay = false;
        for ($i = 0; $i < sizeof($request->input('id')); $i++) {
            $display =  $request->input('display_' . ($i+1)) == 'on'? true : false;
            if ($display){
                $atLeastOneDisplay = true;
            }
        }
        if (!$atLeastOneDisplay) {
            array_push($error_msg, "需要显示至少一个图片");
        }

        // check there should not be empty fields for input 'link'
        $hasEmptyField = false;
        $linksList = $request->input('link');

        foreach ($linksList as $l) {
            if (empty($l)){
                $hasEmptyField = true;
            }
        }

        if ($hasEmptyField){
            array_push($error_msg, "需要填写链接地址");
        }

        //check upload files.

        // if there are files pending to upload.
        if (count($request->file('rolling'))){
            $saved_img_list = [];
            foreach ($request->file('rolling') as $key=>$file){

                $SaveImage = true;
                $image_info = getimagesize($file);
                $image_width = $image_info[0];
                $image_height = $image_info[1];

                if ($image_width < 1024 || $image_height < 500){
                    array_push($error_msg, "第" . ($key+1) . "张图片尺寸不合适");
                    $SaveImage = false;
                }

                $fileName = $file->getClientOriginalName();
                $fileSize = $file->getSize();
                if ($fileSize > 2000000) {
                    array_push($error_msg, "第" . ($key+1) . "张图片文件太大");
                    $SaveImage = false;
                }

                if ($SaveImage){
                    $file->move('img',$fileName);
                    $saved_img_list[$key] = $fileName;
                }
            }
        }

        //$this->validate($request, [ 'link' => 'request' ]);
        if (count($error_msg)){
            return back()->withErrors($error_msg);
        }
        else{

            for ($i = 0; $i<sizeof($request->input('id')); $i++) {
                $homePage = HomePage::find($request->input('id')[$i]);
                $homePage->link = $request->input('link')[$i];
                $display =  $request->input('display_' . ($i+1)) == 'on'? true : false;
                $homePage->display = $display;
                $homePage->updated_at = date('Y-m-d H:i:s');
                if (!empty($saved_img_list[$i])){
                    $homePage->imgURI = $saved_img_list[$i];
                }
                $homePage->save();
            }

            \Session::flash('flash_message','successfully saved.');
            return back();
        }

    	//return var_dump($myCheckBox);
    }

    public function upload_card(Request $request){

        $rules = [
             'link' => 'required',
             'title' => 'required',
             'imgURI' => 'dimensions:min_width=200,max_width=800,min_height=200,max_height=800|max:2048|mimes:jpeg,jpg,gif,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        $types = $request->input('types');

        $messages = [
            'link.required' => '需要填写链接地址',
            'title.required' => '需要填写标题',
            'imgURI.dimensions' => '图片尺寸不合适',
            'imgURI.max:2048' => '图片文件太大',
            'imgURI.mimes:jpeg,jpg,gif,png' => '文件格式不对',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator, $types);
        }
        else{
            $h = HomePage::find($request->input('id'));

            if ($request->hasFile('imgURI')){

                $file = $request->file('imgURI');
                $path = public_path() . '/img/' . $types . '/';
                \Image::make( $file->getRealPath() )->resize(200, 200)->save($path . $file->getClientOriginalName());

                $h->imgURI = $file->getClientOriginalName();

            }

            $h->link = $request->input('link');
            $h->title = $request->input('title');
            $h->text = $request->input('text');
            $h->updated_at = date('Y-m-d H:i:s');
            $display =  $request->input('display') == 'on'? true : false;
            $h->display = $display;
            $h->save();

            \Session::flash($types . '_message','successfully saved.');
            return back();
        }
    }

    public function add_card(Request $request){

        $rules = [
             'link' => 'required',
             'title' => 'required',
             'imgURI' => 'required|dimensions:min_width=200,max_width=800,min_height=200,max_height=800|max:2048|mimes:jpeg,jpg,gif,png',
        ];

        $types = $request->input('types');

        $messages = [
            'link.required' => '需要填写链接地址',
            'title.required' => '需要填写标题',
            'imgURI.required' => '需要上传图片',
            'imgURI.dimensions' => '图片尺寸不合适（最小200*200，最大800*800）',
            'imgURI.max' => '图片文件太大',
            'imgURI.mimes' => '文件格式不对',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator, $types);
        }
        else{
            if ($request->hasFile('imgURI')){

                $file = $request->file('imgURI');
                $path = public_path() . '/img/' . $types . '/';
                \Image::make( $file->getRealPath() )->resize(200, 200)->save($path . $file->getClientOriginalName());

                $data = $request->all();
                $data['imgURI'] = $file->getClientOriginalName();
                $data['type'] = $types;
                $data['created_at'] = date('Y-m-d H:i:s');
                $homePage = new HomePage($data);
                //echo var_dump($homePage);
                $homePage->save();

                \Session::flash($types . '_message','successfully saved.');
                return back();
            }
        }
    }

    // show blogs list to amdin
    public function blog_index(){
        $blogs = Blog::orderby('created_at','desc')->get();
        //cho sizeof($blogs);
        return View('Blog.index', compact('blogs'));
    }

    public function create_blog(){
        return view("Blog.create");
    }

    public function blog_update($id){
        $blogs = Blog::where('id', $id)->get();
        return view('Blog.update', compact('blogs'));
    }

    public function store_blog_updates(Request $request){

        $b = Blog::find($request->input('id'));

        $rules = [
            'thumbnail' => 'dimensions:min_width=200,min_height=150|max:2048|mimes:jpeg,jpg,gif,png',
            'title' => 'required|max:100',
            'venue' => 'required|max:50',
            'event_date' => 'required|date',
            'content' => 'required',
        ];

        $messages = [
            'content.required' => '需要填写内容',
            'title.required' => '需要填写标题',
            'title.max' => '标题文字过长',
            'event_date.required' => '需要填写日期',
            'event_date.required' => '需要填写日期',
            'event_date.date' => '需要正确填写日期',
            'venue.required' => '需要填写地点',
            'venue.max' => '地点文字过长',
            'thumbnail.dimensions' => '图片尺寸太小',
            'thumbnail.max' => '图片文件太大',
            'thumbnail.mimes' => '文件格式不对',
        ];

        $this->validate($request, $rules, $messages);


        if ($request->hasFile('thumbnail')){

            $file = $request->file('thumbnail');
            $path = public_path() . '/img/event/';
            \Image::make( $file->getRealPath() )->save($path . $file->getClientOriginalName());

            $b->thumbnail = $file->getClientOriginalName();

        }


        $time = strtotime($request->input('event_date'));

        $b->title = $request->input('title');
        $b->venue = $request->input('venue');
        $display =  $request->input('display') == 'on'? true : false;
        $b->display = $display;
        $b->content = $request->input('content');

        $newformat = date('Y-m-d',$time);

        $b->event_date = $newformat;

        $b->updated_at = date('Y-m-d H:i:s');

        $b->save();

        \Session::flash('success_message','successfully saved.');
        return back();

    }

    public function store_blog(Request $request){
        $rules = [
            'thumbnail' => 'dimensions:min_width=200,min_height=150|max:2048|mimes:jpeg,jpg,gif,png',
            'title' => 'required|max:100',
            'venue' => 'required|max:50',
            'event_date' => 'required|date',
            'content' => 'required',
        ];

        $messages = [
            'content.required' => '需要填写内容',
            'title.required' => '需要填写标题',
            'title.max' => '标题文字过长',
            'event_date.required' => '需要填写日期',
            'event_date.required' => '需要填写日期',
            'event_date.date' => '需要正确填写日期',
            'venue.required' => '需要填写地点',
            'venue.max' => '地点文字过长',
            'thumbnail.dimensions' => '图片尺寸太小',
            'thumbnail.max' => '图片文件太大',
            'thumbnail.mimes' => '文件格式不对',
        ];

        $this->validate($request, $rules, $messages);

        $data = $request->all();

        if ($request->hasFile('thumbnail')){

            $file = $request->file('thumbnail');
            $path = public_path() . '/img/event/';
            \Image::make( $file->getRealPath() )->save($path . $file->getClientOriginalName());

            $data['thumbnail'] = $file->getClientOriginalName();

        }
        else{
            $data['thumbnail'] = '';
        }

        $time = strtotime($request->input('event_date'));

        $newformat = date('Y-m-d',$time);

        $data['event_date'] = $newformat;
        $data['created_at'] = date('Y-m-d H:i:s');

        $blog = new Blog($data);
        $blog->save();

        \Session::flash('success_message','successfully saved.');
        return back();

    }

    public function allMembers(){
        $members = Member::where('confirm',true)->get();

        return View('Member.all',compact('members'));
    }

    public function confirmMember(Request $request){
        $member = Member::find($request->input('id'));

        $member->confirm = true;

        if (!empty($request->input('rm') && $request->input('rm') == 'yes')){
          Member::where('id',$request->input('id'))->delete();
        }
        else{
          $member->save();
        }
        return back();
    }
}
