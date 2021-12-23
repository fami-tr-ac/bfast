<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'text',
      'post_image'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function favorites()
    {
      return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function getPostCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

     public function getTimeLines(Int $user_id, Array $follow_ids)
    {

        $follow_ids[] = $user_id;
         return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function getPost(Int $post_id)
    {
      return $this->with('user')->where('id', $post_id)->first();
    }

    public function postStore(Int $user_id, Array $data)
    {
      $this->user_id = $user_id;
      $this->text = $data['text'];
      $file_name = $data['post_image']->store('public/post_images/');
      $this->post_image = basename($file_name);

      $this->save();

      return;
      }


    public function getEditPost(Int $user_id, Int $post_id)
    {
        return $this->where('user_id', $user_id)->where('id', $post_id)->first();
    }

    public function postUpdate(Int $post_id, Array $data)
    {
        $this->id = $post_id;
        $this->text = $data['text'];
        $file_name = $data['post_image']->store('public/post_images/');
        $this->post_image = basename($file_name);

        $this->update();

        return;
    }

    public function postDestroy(Int $user_id, Int $post_id)
    {
      return $this->where('user_id', $user_id)->where('id', $post_id)->delete();
    }
}
