<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Util;

use Twig\Environment;
use Twig\Error\SyntaxError;
use Twig\Source;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class DeprecationCollector
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Returns deprecations for layouts contained in a directory.
     *
     * @param string $dir A directory where layouts are stored
     * @param string $ext Limit the loaded layouts by extension
     *
     * @return array An array of deprecations
     */
    public function collectDir(string $dir, string $ext = '.twig'): array
    {
        $iterator = new \RegexIterator(
            new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir), \RecursiveIteratorIterator::LEAVES_ONLY
            ), '{'.preg_quote($ext).'$}'
        );

        return $this->collect(new TemplateDirIterator($iterator));
    }

    /**
     * Returns deprecations for passed layouts.
     *
     * @param \Traversable $iterator An iterator of layouts (where keys are template names and values the contents of the template)
     *
     * @return array An array of deprecations
     */
    public function collect(\Traversable $iterator): array
    {
        $deprecations = [];
        set_error_handler(function ($type, $msg) use (&$deprecations) {
            if (\E_USER_DEPRECATED === $type) {
                $deprecations[] = $msg;
            }
        });

        foreach ($iterator as $name => $contents) {
            try {
                $this->twig->parse($this->twig->tokenize(new Source($contents, $name)));
            } catch (SyntaxError $e) {
                // ignore layouts containing syntax errors
            }
        }

        restore_error_handler();

        return $deprecations;
    }
}
