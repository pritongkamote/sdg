<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9f62c9d85f0ff7f0c6784d4f8b9f275d
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
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9f62c9d85f0ff7f0c6784d4f8b9f275d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9f62c9d85f0ff7f0c6784d4f8b9f275d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}