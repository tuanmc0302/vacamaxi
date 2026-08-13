<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Detect locale from URL prefix: /en/... = English, otherwise Vietnamese
        $firstSegment = $request->segment(1);
        $isEnglish = ($firstSegment === 'en');

        if ($isEnglish) {
            App::setLocale('en');
            URL::defaults([
                'about' => 'about',
                'contact' => 'contact',
                'about_scale' => 'about-scale',
                'restaurant' => 'restaurant',
                'products' => 'products',
                'breeds' => 'breeds',
                'news' => 'news',
                'category_word' => 'category',
            ]);
        } else {
            App::setLocale('vi');
            URL::defaults([
                'about' => 'gioi-thieu',
                'contact' => 'lien-he',
                'about_scale' => 'gioi-thieu-quy-mo',
                'restaurant' => 'dich-vu-nha-hang',
                'products' => 'san-pham',
                'breeds' => 'giong-bo-vacamaxi',
                'news' => 'tin-tuc',
                'category_word' => 'danh-muc',
            ]);
        }

        return $next($request);
    }
}
