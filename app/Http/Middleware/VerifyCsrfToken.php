<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'login',
        'register',
        'logout',
        'Subscription/*',
        'tools_Conversation/*',
        'ai_tools_template/*',
        'document_data/*',
        'ai_tools_list/*',
        'Blogs_admin/*',
    ];
}
