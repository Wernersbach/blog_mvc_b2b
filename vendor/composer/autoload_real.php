<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite2ac07ba4444c11f49f78210af4b565b
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

        spl_autoload_register(array('ComposerAutoloaderInite2ac07ba4444c11f49f78210af4b565b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite2ac07ba4444c11f49f78210af4b565b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite2ac07ba4444c11f49f78210af4b565b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
