<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use App\Handlers\ImageUploadHandler;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    // 显示用户详情
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    // 编辑用户信息
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
    // 更新用户信息
    public function update(UserUpdateRequest $request, User $user, ImageUploadHandler $uploader)
    {
        $this->authorize('update', $user);
        $data = $request->all();
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatar', $user->id, 400, true);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        // session()->flash('success', '更新成功');
        return redirect()->route('users.show', $user->id)->with('success', '更新成功');
        // dd($request->all());
    }
}
