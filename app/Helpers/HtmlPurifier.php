<?php

namespace App\Helpers;

/**
 * HtmlPurifier provides an ability to clean up HTML from any harmful code.
 *
 * @author Alexander Schilling
 */
class HtmlPurifier
{

    /**
     * Process
     *
     * @param string $content
     *
     * @return string
     */
    public static function process(string $content): string
    {
        $configInstance = \HTMLPurifier_Config::create(null);

        $configInstance->autoFinalize = false;

        $purifier = \HTMLPurifier::instance($configInstance);
        $purifier->config->set('Cache.SerializerPath', config('cache.stores.file.path'));
        $purifier->config->set('Cache.SerializerPermissions', 0775);

        return $purifier->purify($content);
    }
}
