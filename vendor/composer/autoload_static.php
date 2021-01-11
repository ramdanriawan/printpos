<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd3dc04ea78ef5c7ac190388106cbb4b
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/gfx-php/src/Mike42',
            1 => __DIR__ . '/..' . '/mike42/escpos-php/src/Mike42',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd3dc04ea78ef5c7ac190388106cbb4b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd3dc04ea78ef5c7ac190388106cbb4b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfd3dc04ea78ef5c7ac190388106cbb4b::$classMap;

        }, null, ClassLoader::class);
    }
}
