<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Response;

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
        $projectId = $request->request->get('project_id');

        if (Project::find($projectId)) {
            return $next($request);
        }

        return new Response("Incorrect Project ID specified", 400);
    }
}
