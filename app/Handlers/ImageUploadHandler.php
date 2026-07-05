<?php

namespace App\Handlers;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ImageUploadHandler
{
    //允许上传的图片格式
    protected $allowed_ext = ['jpg', 'png', 'gif', 'jpeg'];

    //保存图片的方法，最终返回一个图片所在的url地址
    public function save($file, $folder, $model_id, $max_width = false, $unlink = false)
    {
        //文件夹
        $folder_name = "uploads/images/{$folder}/" . date('Ym/d', time());
        //文件夹的物理地址
        $upload_path = public_path() . '/' . $folder_name;
        //获取文件后缀
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        //获取唯一文件名
        $filename = md5($model_id . time()) . '.' . $extension;
        //判断是不是图片
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }
        //将图片从临时保存区移动到指定位置，并重新命名
        $file->move($upload_path, $filename);

        //判断是否需要压缩
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }
        //删除旧的图片
        if ($unlink) {
            $this->delOldImage($model_id);
        }
        //返回图片所在的url地址
        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }
    public function reduceSize($file_path, $max_width)
    {
        //实例化
        $image = Image::make($file_path);
        //缩放
        $image->resize($max_width, null, function ($obj) {
            //等比例缩放
            $obj->aspectRatio();
            //防止放大
            $obj->upsize();
        });
        $image->save();
    }
    public function delOldImage($user_id)
    {
        $user = DB::table('users')->find($user_id);

        // 1. 确保用户存在，并且数据库中确实存有头像的 URL
        if ($user && !empty($user->avatar)) {

            // 2. 核心原理：提取 URL 中的 Path 部分
            // 比如 http://bbs_chat.test/uploads/images/xxx.png 
            // 提取后只会得到纯净的相对路径： /uploads/images/xxx.png
            $url_path = parse_url($user->avatar, PHP_URL_PATH);

            if ($url_path) {
                // 3. 构建绝对物理路径
                // ltrim() 是为了去掉开头的 '/'，防止与 public_path() 自带的路径产生双斜杠
                $real_path = public_path(ltrim($url_path, '/'));

                // 4. 执行物理校验与删除（坚决抛弃 @ 抑制符）
                // 只有当文件在硬盘上真实存在时，才执行删除指令
                if (file_exists($real_path)) {
                    unlink($real_path);
                }
            }
        }
    }
}
