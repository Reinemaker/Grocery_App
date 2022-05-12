<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;

/**
 * This class is copied in every Composer installed project and available to all
 *
 * See also https://getcomposer.org/doc/07-runtime.md#installed-versions
 *
 * To require its presence, you can require `composer-runtime-api ^2.0`
 */
class InstalledVersions
{
<<<<<<< Updated upstream
    /**
     * @var mixed[]|null
     * @psalm-var array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[], dev: bool, install_path: string, type: string}, versions: array<string, array{dev_requirement: bool, pretty_version?: string, version?: string, aliases?: string[], reference?: string, replaced?: string[], provided?: string[], install_path?: string, type?: string}>}|array{}|null
     */
    private static $installed;

    /**
     * @var bool|null
     */
    private static $canGetVendors;

    /**
     * @var array[]
     * @psalm-var array<string, array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[], dev: bool, install_path: string, type: string}, versions: array<string, array{dev_requirement: bool, pretty_version?: string, version?: string, aliases?: string[], reference?: string, replaced?: string[], provided?: string[], install_path?: string, type?: string}>}>
     */
    private static $installedByVendor = array();

    /**
     * Returns a list of all package names which are present, either by being installed, replaced or provided
     *
     * @return string[]
     * @psalm-return list<string>
     */
    public static function getInstalledPackages()
    {
        $packages = array();
        foreach (self::getInstalled() as $installed) {
            $packages[] = array_keys($installed['versions']);
        }

        if (1 === \count($packages)) {
            return $packages[0];
        }

        return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
    }

    /**
     * Returns a list of all package names with a specific type e.g. 'library'
     *
     * @param  string   $type
     * @return string[]
     * @psalm-return list<string>
     */
    public static function getInstalledPackagesByType($type)
    {
        $packagesByType = array();

        foreach (self::getInstalled() as $installed) {
            foreach ($installed['versions'] as $name => $package) {
                if (isset($package['type']) && $package['type'] === $type) {
                    $packagesByType[] = $name;
                }
            }
        }

        return $packagesByType;
    }

    /**
     * Checks whether the given package is installed
     *
     * This also returns true if the package name is provided or replaced by another package
     *
     * @param  string $packageName
     * @param  bool   $includeDevRequirements
     * @return bool
     */
    public static function isInstalled($packageName, $includeDevRequirements = true)
    {
        foreach (self::getInstalled() as $installed) {
            if (isset($installed['versions'][$packageName])) {
                return $includeDevRequirements || empty($installed['versions'][$packageName]['dev_requirement']);
            }
        }

        return false;
    }

    /**
     * Checks whether the given package satisfies a version constraint
     *
     * e.g. If you want to know whether version 2.3+ of package foo/bar is installed, you would call:
     *
     *   Composer\InstalledVersions::satisfies(new VersionParser, 'foo/bar', '^2.3')
     *
     * @param  VersionParser $parser      Install composer/semver to have access to this class and functionality
     * @param  string        $packageName
     * @param  string|null   $constraint  A version constraint to check for, if you pass one you have to make sure composer/semver is required by your package
     * @return bool
     */
    public static function satisfies(VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));

        return $provided->matches($constraint);
    }

    /**
     * Returns a version constraint representing all the range(s) which are installed for a given package
     *
     * It is easier to use this via isInstalled() with the $constraint argument if you need to check
     * whether a given version of a package is installed, and not just whether it exists
     *
     * @param  string $packageName
     * @return string Version constraint usable with composer/semver
     */
    public static function getVersionRanges($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            $ranges = array();
            if (isset($installed['versions'][$packageName]['pretty_version'])) {
                $ranges[] = $installed['versions'][$packageName]['pretty_version'];
            }
            if (array_key_exists('aliases', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
            }
            if (array_key_exists('replaced', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
            }
            if (array_key_exists('provided', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
            }

            return implode(' || ', $ranges);
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @param  string      $packageName
     * @return string|null If the package is being replaced or provided but is not really installed, null will be returned as version, use satisfies or getVersionRanges if you need to know if a given version is present
     */
    public static function getVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['version'])) {
                return null;
            }

            return $installed['versions'][$packageName]['version'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @param  string      $packageName
     * @return string|null If the package is being replaced or provided but is not really installed, null will be returned as version, use satisfies or getVersionRanges if you need to know if a given version is present
     */
    public static function getPrettyVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['pretty_version'])) {
                return null;
            }

            return $installed['versions'][$packageName]['pretty_version'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @param  string      $packageName
     * @return string|null If the package is being replaced or provided but is not really installed, null will be returned as reference
     */
    public static function getReference($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['reference'])) {
                return null;
            }

            return $installed['versions'][$packageName]['reference'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @param  string      $packageName
     * @return string|null If the package is being replaced or provided but is not really installed, null will be returned as install path. Packages of type metapackages also have a null install path.
     */
    public static function getInstallPath($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            return isset($installed['versions'][$packageName]['install_path']) ? $installed['versions'][$packageName]['install_path'] : null;
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }

    /**
     * @return array
     * @psalm-return array{name: string, version: string, reference: string, pretty_version: string, aliases: string[], dev: bool, install_path: string, type: string}
     */
    public static function getRootPackage()
    {
        $installed = self::getInstalled();

        return $installed[0]['root'];
    }

    /**
     * Returns the raw installed.php data for custom implementations
     *
     * @deprecated Use getAllRawData() instead which returns all datasets for all autoloaders present in the process. getRawData only returns the first dataset loaded, which may not be what you expect.
     * @return array[]
     * @psalm-return array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[], dev: bool, install_path: string, type: string}, versions: array<string, array{dev_requirement: bool, pretty_version?: string, version?: string, aliases?: string[], reference?: string, replaced?: string[], provided?: string[], install_path?: string, type?: string}>}
     */
    public static function getRawData()
    {
        @trigger_error('getRawData only returns the first dataset loaded, which may not be what you expect. Use getAllRawData() instead which returns all datasets for all autoloaders present in the process.', E_USER_DEPRECATED);

        if (null === self::$installed) {
            // only require the installed.php file if this file is loaded from its dumped location,
            // and not from its source location in the composer/composer package, see https://github.com/composer/composer/issues/9937
            if (substr(__DIR__, -8, 1) !== 'C') {
                self::$installed = include __DIR__ . '/installed.php';
            } else {
                self::$installed = array();
            }
        }

        return self::$installed;
    }

    /**
     * Returns the raw data of all installed.php which are currently loaded for custom implementations
     *
     * @return array[]
     * @psalm-return list<array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[], dev: bool, install_path: string, type: string}, versions: array<string, array{dev_requirement: bool, pretty_version?: string, version?: string, aliases?: string[], reference?: string, replaced?: string[], provided?: string[], install_path?: string, type?: string}>}>
     */
    public static function getAllRawData()
    {
        return self::getInstalled();
    }

    /**
     * Lets you reload the static array from another file
     *
     * This is only useful for complex integrations in which a project needs to use
     * this class but then also needs to execute another project's autoloader in process,
     * and wants to ensure both projects have access to their version of installed.php.
     *
     * A typical case would be PHPUnit, where it would need to make sure it reads all
     * the data it needs from this class, then call reload() with
     * `require $CWD/vendor/composer/installed.php` (or similar) as input to make sure
     * the project in which it runs can then also use this class safely, without
     * interference between PHPUnit's dependencies and the project's dependencies.
     *
     * @param  array[] $data A vendor/composer/installed.php data set
     * @return void
     *
     * @psalm-param array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[], dev: bool, install_path: string, type: string}, versions: array<string, array{dev_requirement: bool, pretty_version?: string, version?: string, aliases?: string[], reference?: string, replaced?: string[], provided?: string[], install_path?: string, type?: string}>} $data
     */
    public static function reload($data)
    {
        self::$installed = $data;
        self::$installedByVendor = array();
    }

    /**
     * @return array[]
     * @psalm-return list<array{root: array{name: string, version: string, reference: string, pretty_version: string, aliases: string[], dev: bool, install_path: string, type: string}, versions: array<string, array{dev_requirement: bool, pretty_version?: string, version?: string, aliases?: string[], reference?: string, replaced?: string[], provided?: string[], install_path?: string, type?: string}>}>
     */
    private static function getInstalled()
    {
        if (null === self::$canGetVendors) {
            self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
        }

        $installed = array();

        if (self::$canGetVendors) {
            foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
                if (isset(self::$installedByVendor[$vendorDir])) {
                    $installed[] = self::$installedByVendor[$vendorDir];
                } elseif (is_file($vendorDir.'/composer/installed.php')) {
                    $installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
                    if (null === self::$installed && strtr($vendorDir.'/composer', '\\', '/') === strtr(__DIR__, '\\', '/')) {
                        self::$installed = $installed[count($installed) - 1];
                    }
                }
            }
        }

        if (null === self::$installed) {
            // only require the installed.php file if this file is loaded from its dumped location,
            // and not from its source location in the composer/composer package, see https://github.com/composer/composer/issues/9937
            if (substr(__DIR__, -8, 1) !== 'C') {
                self::$installed = require __DIR__ . '/installed.php';
            } else {
                self::$installed = array();
            }
        }
        $installed[] = self::$installed;

        return $installed;
    }
=======
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-main',
    'version' => 'dev-main',
    'aliases' => 
    array (
    ),
    'reference' => '1cefb140b0a4f44baecc9a3b69e04c41555e10e3',
    'name' => '__root__',
  ),
  'versions' => 
  array (
    '__root__' => 
    array (
      'pretty_version' => 'dev-main',
      'version' => 'dev-main',
      'aliases' => 
      array (
      ),
      'reference' => '1cefb140b0a4f44baecc9a3b69e04c41555e10e3',
    ),
    'clue/stream-filter' => 
    array (
      'pretty_version' => 'v1.6.0',
      'version' => '1.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd6169430c7731d8509da7aecd0af756a5747b78e',
    ),
    'doctrine/annotations' => 
    array (
      'pretty_version' => '1.13.2',
      'version' => '1.13.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '5b668aef16090008790395c02c893b1ba13f7e08',
    ),
    'doctrine/lexer' => 
    array (
      'pretty_version' => '1.2.3',
      'version' => '1.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c268e882d4dbdd85e36e4ad69e02dc284f89d229',
    ),
    'firebase/php-jwt' => 
    array (
      'pretty_version' => 'v6.1.2',
      'version' => '6.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c297139da7c6873dbd67cbd1093f09ec0bbd0c50',
    ),
    'guzzlehttp/guzzle' => 
    array (
      'pretty_version' => '6.5.5',
      'version' => '6.5.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
    ),
    'guzzlehttp/promises' => 
    array (
      'pretty_version' => '1.5.1',
      'version' => '1.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
    ),
    'guzzlehttp/psr7' => 
    array (
      'pretty_version' => '1.8.5',
      'version' => '1.8.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '337e3ad8e5716c15f9657bd214d16cc5e69df268',
    ),
    'konekt/pdf-invoice' => 
    array (
      'pretty_version' => '1.7.0',
      'version' => '1.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ef14d55f7d1e572b92b85d35ac86b065736400b3',
    ),
    'league/omnipay' => 
    array (
      'pretty_version' => 'v3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '413793c87a29edab98443f71a707982f4311822c',
    ),
    'moneyphp/money' => 
    array (
      'pretty_version' => 'v4.0.3',
      'version' => '4.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd945f775bd6ab0920d9d205813d8831a899a8844',
    ),
    'monolog/monolog' => 
    array (
      'pretty_version' => '2.6.0',
      'version' => '2.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '247918972acd74356b0a91dfaa5adcaec069b6c0',
    ),
    'omnipay/common' => 
    array (
      'pretty_version' => 'v3.2.0',
      'version' => '3.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e278ff00676c05cd0f4aaaf6189a226f26ae056e',
    ),
    'omnipay/dummy' => 
    array (
      'pretty_version' => 'v3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bfddc1e3127b7df41a5291213b314fdb4c66f6a2',
    ),
    'omnipay/paypal' => 
    array (
      'pretty_version' => 'v3.0.2',
      'version' => '3.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '519db61b32ff0c1e56cbec94762b970ee9674f65',
    ),
    'php-http/async-client-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'php-http/client-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'php-http/discovery' => 
    array (
      'pretty_version' => '1.14.1',
      'version' => '1.14.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'de90ab2b41d7d61609f504e031339776bc8c7223',
    ),
    'php-http/guzzle6-adapter' => 
    array (
      'pretty_version' => 'v1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a56941f9dc6110409cfcddc91546ee97039277ab',
    ),
    'php-http/httplug' => 
    array (
      'pretty_version' => 'v1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1c6381726c18579c4ca2ef1ec1498fdae8bdf018',
    ),
    'php-http/message' => 
    array (
      'pretty_version' => '1.13.0',
      'version' => '1.13.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7886e647a30a966a1a8d1dad1845b71ca8678361',
    ),
    'php-http/message-factory' => 
    array (
      'pretty_version' => 'v1.0.2',
      'version' => '1.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a478cb11f66a6ac48d8954216cfed9aa06a501a1',
    ),
    'php-http/message-factory-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'php-http/promise' => 
    array (
      'pretty_version' => '1.1.0',
      'version' => '1.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
    ),
    'psr/cache' => 
    array (
      'pretty_version' => '3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'aa5030cfa5405eccfdcb1083ce040c2cb8d253bf',
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
    ),
    'psr/http-message-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fe5ea303b0887d5caefd3d431c3e61ad47037001',
    ),
    'psr/log-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0.0 || 2.0.0 || 3.0.0',
      ),
    ),
    'ralouphie/getallheaders' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '120b605dfeb996808c31b6477290a714d356e822',
    ),
    'setasign/fpdf' => 
    array (
      'pretty_version' => '1.8.4',
      'version' => '1.8.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b0ddd9c5b98ced8230ef38534f6f3c17308a7974',
    ),
    'symfony/deprecation-contracts' => 
    array (
      'pretty_version' => 'v3.0.1',
      'version' => '3.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '26954b3d62a6c5fd0ea8a2a00c0353a14978d05c',
    ),
    'symfony/finder' => 
    array (
      'pretty_version' => 'v6.0.8',
      'version' => '6.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'af7edab28d17caecd1f40a9219fc646ae751c21f',
    ),
    'symfony/http-foundation' => 
    array (
      'pretty_version' => 'v6.0.8',
      'version' => '6.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c9c86b02d7ef6f44f3154acc7de42831518afe7c',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.25.0',
      'version' => '1.25.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '30885182c981ab175d4d034db0f6f469898070ab',
    ),
    'symfony/polyfill-intl-idn' => 
    array (
      'pretty_version' => 'v1.25.0',
      'version' => '1.25.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '749045c69efb97c70d25d7463abba812e91f3a44',
    ),
    'symfony/polyfill-intl-normalizer' => 
    array (
      'pretty_version' => 'v1.25.0',
      'version' => '1.25.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8590a5f561694770bdcd3f9b5c69dde6945028e8',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.25.0',
      'version' => '1.25.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '0abb51d2f102e00a4eefcf46ba7fec406d245825',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.25.0',
      'version' => '1.25.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9a142215a36a3888e30d0a9eeea9766764e96976',
    ),
    'symfony/yaml' => 
    array (
      'pretty_version' => 'v6.0.3',
      'version' => '6.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e77f3ea0b21141d771d4a5655faa54f692b34af5',
    ),
    'zircote/swagger-php' => 
    array (
      'pretty_version' => '3.3.4',
      'version' => '3.3.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '7313ff7d1991d00e52d0e852087693d4482df631',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}


if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}




private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {

foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
>>>>>>> Stashed changes
}
