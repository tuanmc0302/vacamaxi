<?php

namespace App\Helpers;

class SlugHelper
{
    private static array $viToEn = [
        'ruou' => 'wine',
        'thit' => 'beef',
        'bo' => 'cattle',
        'giong-bo-vacamaxi' => 'breeds',
        'nong-nghiep' => 'agriculture',
        'nganh-thuc-pham-do-uong' => 'food-beverage',
        'am-thuc-steak' => 'cuisine-steak',
        'kinh-nghiem-chan-nuoi' => 'husbandry-experience',
        'tin-tuc-vaca-maxi' => 'vacamaxi-news',
        
        // Products
        'ruou-sam-369' => 'ginseng-wine-369',
        'ruou-trang-tam-coc' => 'tam-coc-white-wine',
        'giong-vaca-a' => 'vaca-breed-a',
        'giong-vaca-b' => 'vaca-breed-b',
        'giong-vaca-g' => 'vaca-breed-g',
        'giong-vaca-s' => 'vaca-breed-s',
        'giong-vaca-f' => 'vaca-breed-f',
        'giong-vaca-n' => 'vaca-breed-n',
        'giong-vaca-h' => 'vaca-breed-h',
        'vaca-g' => 'vaca-g',
        'vaca-b' => 'vaca-b',
        'vaca-a' => 'vaca-a',
        'vaca-f' => 'vaca-f',
        'vaca-i' => 'vaca-i',
        'vaca-h' => 'vaca-h',
        'vaca-n' => 'vaca-n',

        // Posts
        've-vaca-maxi' => 'about-vaca-maxi',
    ];

    private static ?array $enToVi = null;

    public static function toVi(string $slug): string
    {
        if (self::$enToVi === null) {
            self::$enToVi = array_flip(self::$viToEn);
        }
        return self::$enToVi[$slug] ?? $slug;
    }

    public static function toEn(string $slug): string
    {
        return self::$viToEn[$slug] ?? $slug;
    }

    public static function translate(string $slug, string $locale): string
    {
        return $locale === 'en' ? self::toEn($slug) : self::toVi($slug);
    }
}
