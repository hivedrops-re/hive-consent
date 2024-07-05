<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit675eb3597ccff23d354e6a485981fb1b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit675eb3597ccff23d354e6a485981fb1b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit675eb3597ccff23d354e6a485981fb1b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit675eb3597ccff23d354e6a485981fb1b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
