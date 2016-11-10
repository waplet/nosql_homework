<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\JsonResponse;

class ApiProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projectId = $request->input('project_id');

        if (Project::find($projectId)) {
            return $next($request);
        }

        return new JsonResponse("Incorrect Project ID specified", 400);
    }
}
