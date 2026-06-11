<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Vérifie si l'utilisateur est connecté et a le bon rôle
        if (!$request->user() || $request->user()->role !== $role) {
            return redirect('/dashboard')
                ->with('error', 'Accès refusé. Vous n\'avez pas les droits nécessaires.');
        }

        return $next($request);
    }
}