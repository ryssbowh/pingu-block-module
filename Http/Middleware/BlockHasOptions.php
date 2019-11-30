<?php

namespace Pingu\Block\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Pingu\Block\Entities\Block;
use Pingu\Block\Exceptions\BlockException;
use Pingu\Core\Exceptions\ParameterMissing;

class BlockHasOptions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $blockSlug)
    {
        $block = $request->route($blockSlug);
        if ($block instanceof Block) {
            $block = $block->instance();
        }
        if (!$block->hasOptions()) {
            throw BlockException::noOptions($block);
        }

        return $next($request);
    }
}
