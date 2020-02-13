<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post;
use App\Repositories\PostRepositoryInterface;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return $this->postRepository->all($request->get('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Post $request
     * @return Response
     */
    public function store(Post $request)
    {
        return $this->postRepository->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return $this->postRepository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Post $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Post $request, $id)
    {
        return response()->json(['status' => $this->postRepository->update($id, $request->validated())]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        return response()->json(['status' => $this->postRepository->delete($id)]);
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function postUploadImage(Request $request)
    {
        $file = $request->file('file');

        $filename = (new DateTime())->getTimestamp() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads', $filename);
        return URL::to("uploads/$filename");
    }
}
