<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //个人中心页面
    public function index(User $user)
    {
        //个人信息：关注数/粉丝数/文章数
        $user = User::withCount(['posts', 'fans', 'stars'])->find($user->id);
        //个人文章列表
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();
        //关注的用户列表：关注数/粉丝数/文章数
        $stars = $user->stars;
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['posts', 'fans', 'stars'])->get();
        //被关注用户列表：关注数/粉丝数/文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['posts', 'fans', 'stars'])->get();

        return view('user.index', compact('user', 'posts', 'fusers', 'susers'));
    }

    //关注
    public function fan(User $user)
    {
        $me = Auth::user();
        $me->doFan($user->id);

        return [
            'error' => 0,
            'msg' => ''
        ];
    }
    //取消关注
    public function unfan(User $user)
    {
        $me = Auth::user();
        $me->doUnfan($user->id);

        return [
            'error' => 0,
            'msg' => ''
        ];
    }

    //个人设置页面
    public function setting()
    {
        return view('user.setting');
    }
    //个人设置保存
    public function settingStore()
    {
        //个人页面设置行为
    }

}
