<?php

namespace App\Http\Controllers;

use App\Events\NewUserHasRegisteredEvent;
use App\Http\Requests\ChangeUserType;
use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->userRepository->all();
    }

    /**
     * @param Register $request
     * @return JsonResponse
     */
    public function postRegister(Register $request)
    {
        event(new NewUserHasRegisteredEvent($this->userRepository->create($request->validated())));
        if (!$token = auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        return response()->json([
            'accessToken' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => auth()->factory()->getTTL() * 60,
            'accountType' => auth()->user()->type
        ]);
    }

    /**
     * @param Login $request
     * @return JsonResponse
     */
    public function postLogin(Login $request)
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        return response()->json(['status' => $this->userRepository->delete($id)]);
    }

    /**
     * @param ChangeUserType $changeUserType
     * @param int $id
     * @return JsonResponse
     */
    public function changeType(ChangeUserType $changeUserType, int $id)
    {
        return response()->json(['status' => $this->userRepository->update($id, $changeUserType->validated())]);
    }

    /**
     * @return JsonResponse
     */
    public function postLogout()
    {
        auth()->logout();

        return response()->json(['message' => 'logged out']);
    }
}
