<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

class MemberController extends Controller
{
    public function index() {

    	return View('Member.index');
    }

    public function store(Request $request){

        \Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

    	$rules = [
    		'name' => 'required|max:5|alpha',
    		'pinyin' => 'required|max:25|alpha_spaces',
    		'e_name' => 'max:50|alpha_spaces',
    		'n_name' => 'max:20|alpha-num',
    		'birthday' => 'required|date',
    		'birth_place' => 'required|max:50',
    		'address' => 'required|max:50',
    		'occupation' => 'required|max:50',
    		'o_nationality' => 'required|max:30',
    		'c_nationality' => 'max:30|alpha',
    		'findus' => 'required',
    		'hobby' => 'max:200',

    		'contact' => 'digits_between:8,11',
    		'mobile' => 'required|digits_between:8,11',
    		'email' => 'required|email',
    		'wechat' => array('required','max:20','min:6', 'regex:/^[\-a-zA-Z0-9_]{6,}$/'),

    	];

    	$message = [
    		'name.required' => '需要填写 ‘姓名’',
    		'name.max' => '‘姓名’ 填写过长 （不要超过10个字）',
            'e_name.alpha_spaces' => '‘英文名’ 填写不正确 （只能输入字母和空格）',
            'n_name.alpha-num' => '‘昵称’ 填写不正确 （只能输入数字和字）',
    		'pinyin.required' => '需要填写 ‘姓名拼音’',
            'pinyin.alpha_spaces' => '‘拼音’ 填写不正确 （只能含有字母和空格）',
    		'pinyin.max' => '‘姓名拼音’ 填写过长 （不要超过20个字母）',
    		'birthday.required' => '需要填写 ‘生日’',
    		'birthday.date' => '‘生日’ 日期格式不对',
    		'birth_place.required' => '需要填写 ‘出生地’',
    		'address.required' => '需要填写 ‘常住地’',
    		'address.max' => '‘常住地’ 填写过长 （不要超过25个字）' ,
    		'occupation.required' => '需要填写 ‘行业’',
    		'occupation.max' => '‘行业’ 填写过长 （不要超过25个字）',
    		'o_nationality.required' => '需要填写 ‘国籍’',
    		'o_nationality.max' => '‘国籍’ 填写过长 （不要超过15个字）',
    		'findus.required' => '需要填写 ‘了解我们的途径’',
    		'hobby.max' => '‘个人爱好’ 填写过长 （不要超过100个字）',

    		'contact.digits_between' => '‘电话’ 输入不正确 （只能填写8位或11位数字）',
    		'mobile.required' => '需要填写 ‘手机’',
    		'mobile.digits_between' => '‘手机’ 输入不正确 （只能填写8位或11位数字）',
    		'email.required' => '需要填写 ‘邮箱’',
    		'email.email' => '‘邮箱’ 填写不正确 （请填写正确的邮箱地址）',
    		'wechat.required' => '需要填写 ‘微信号’',
    		'wechat.max' => '‘微信号’ 填写过长（不要超过20个字母，数字或符号）',
        'wechat.min' => '‘微信号’ 填写过短（不要低于6位字母，数字或符号）',
            'wechat.regex' => '‘微信号’ 只能包含6-20位字母，数字，下划线和减号',
    	];

    	$this->validate($request, $rules, $message);

        $data = $request->all();
        $newformat = date('Y-m-d',strtotime($data['birthday']));
        $data['birthday'] = $newformat;
    	$member = new Member($data);

    	$member->save();

        \Session::flash('success_message','申请成功， 请耐心等待管理员确认。');
    	return back();

    }

}
