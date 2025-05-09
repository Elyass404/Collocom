<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Interfaces\UserRepositoryInterface;

class CheckPermission
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, Closure $next, $permission): Response
    {
        $user = Auth::user();

        if (!$user || !$this->userRepository->hasPermission($user->id, $permission)) {
            // Redirect to the custom 403 page instead of returning JSON
            abort(403);
        }

        return $next($request);
    }
}
