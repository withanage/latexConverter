<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0696d5303e0b54e4c8ddebe750ffb5ad
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'TIBHannover\\LatexConverter\\Action\\Convert' => __DIR__ . '/../..' . '/classes/Action/Convert.inc.php',
        'TIBHannover\\LatexConverter\\Action\\Extract' => __DIR__ . '/../..' . '/classes/Action/Extract.inc.php',
        'TIBHannover\\LatexConverter\\Components\\Forms\\SettingsForm' => __DIR__ . '/../..' . '/classes/Components/Forms/SettingsForm.inc.php',
        'TIBHannover\\LatexConverter\\Handler\\PluginHandler' => __DIR__ . '/../..' . '/classes/Handler/PluginHandler.inc.php',
        'TIBHannover\\LatexConverter\\Models\\ArticleGalley' => __DIR__ . '/../..' . '/classes/Models/ArticleGalley.inc.php',
        'TIBHannover\\LatexConverter\\Models\\Cleanup' => __DIR__ . '/../..' . '/classes/Models/Cleanup.inc.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit0696d5303e0b54e4c8ddebe750ffb5ad::$classMap;

        }, null, ClassLoader::class);
    }
}
