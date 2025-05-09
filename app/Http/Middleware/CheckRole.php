<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        if (!$user || !$this->userRepository->hasRole($user->id, $role)) {
            // return response()->json(['message' => 'Forbidden - You do not have the required role'], 403);
            abort(403);
        }

        return $next($request);
    }
}
