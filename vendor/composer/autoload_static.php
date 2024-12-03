<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7fd491e0eb14042dc00b9925fd66e62f
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JoPi\\App\\Entities\\' => 18,
            'JoPi\\App\\' => 9,
        ),
        'C' => 
        array (
            'Custom\\Routes\\' => 14,
            'Custom\\Middelware\\' => 18,
            'Custom\\Entities\\' => 16,
            'Custom\\Controllers\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JoPi\\App\\Entities\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/entities',
        ),
        'JoPi\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Custom\\Routes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/routes',
        ),
        'Custom\\Middelware\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/middleware',
        ),
        'Custom\\Entities\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/entities',
        ),
        'Custom\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7fd491e0eb14042dc00b9925fd66e62f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7fd491e0eb14042dc00b9925fd66e62f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7fd491e0eb14042dc00b9925fd66e62f::$classMap;

        }, null, ClassLoader::class);
    }
}