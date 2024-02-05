<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function index()
    {

        try {
            return view('welcome', ['results' => Post::all()]);
        } catch (\Throwable $th) {
            logger('Failed to save', [$th]);
        }
    }

    public function createOrUpdate(Request $request)
    {
        try {

            DB::beginTransaction();
            $post = new Post();

            $post->fill($request->all());
            $post->save();

            DB::commit();

            return response()->json(['id'=> $post->id, 'name' => $post->name, 'mobile'=>$post->mobile]);
        } catch (\Exception $e) {
            DB::rollBack();
            logger('Failed ', [$e->getMessage()]);
        }
    }

    public function delete($post)
    {
        try {

            $post = Post::find($post);

            DB::beginTransaction();

            $post->delete();

            DB::commit();

            return response()->json(['message' => 'Deleted success']);
        } catch (\Exception $e) {
            DB::rollBack();
            logger('Failed ', [$e->getMessage()]);
        }
    }
}
