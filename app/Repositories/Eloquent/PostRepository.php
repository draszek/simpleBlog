<?php

namespace App\Repositories\Eloquent;

use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Posts;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Exception;

class PostRepository implements PostRepositoryInterface
{

    /**
     * @param $data
     * @return PostResource
     */
    public function create($data)
    {
        $data['user_id'] = auth()->user()->id;

        return new PostResource(Post::create($data));
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $post = Post::find($id);

        foreach ($data as $key => $value) {
            try {
                $post->{$key} = $value;
            } catch (Exception $e) {
                continue;
            }
        }

        return $post->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param $id
     * @return PostResource
     */
    public function find($id)
    {
        return new PostResource(Post::find($id));
    }

    /**
     * @param null $page
     * @return Posts
     */
    public function all($page = null)
    {
        $posts = [];
        if(!empty($page)) {
            $posts = Post::offset(($page -1) * 10)->limit(10)->get();
        } else {
            $posts = Post::all();
        }
        return new Posts($posts);
    }
}
