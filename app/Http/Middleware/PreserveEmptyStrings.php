<?php

namespace App\Http\Middleware;

use Closure;

class PreserveEmptyStrings
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
        $request->merge($this->preserveEmptyStrings($request->all()));

        return $next($request);
    }

    /**
     * Recursively preserve empty strings in the array.
     *
     * @param  array  $array
     * @return array
     */
    private function preserveEmptyStrings(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->preserveEmptyStrings($value);
            } else {
                if ($value === null) {
                    $array[$key] = '';
                }
                if ($value === '') {
                    $array[$key] = '';
                }
            }
        }

        return $array;
    }
}
