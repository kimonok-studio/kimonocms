<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit002e6de09ea9a786119e9b72ef45ec62
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fakerphp/faker/src/Faker',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit002e6de09ea9a786119e9b72ef45ec62::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit002e6de09ea9a786119e9b72ef45ec62::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit002e6de09ea9a786119e9b72ef45ec62::$classMap;

        }, null, ClassLoader::class);
    }
}
