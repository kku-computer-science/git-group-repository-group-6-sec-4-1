<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Dumper;

use Symfony\Component\Translation\MessageCatalogue;

/**
 * PhpFileDumper generates PHP files from a message catalogue.
 *
 * @author Michel Salib <michelsalib@hotmail.com>
 */
class PhpFileDumper extends FileDumper
{
<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function formatCatalogue(MessageCatalogue $messages, string $domain, array $options = [])
=======
    public function formatCatalogue(MessageCatalogue $messages, string $domain, array $options = []): string
>>>>>>> main
    {
        return "<?php\n\nreturn ".var_export($messages->all($domain), true).";\n";
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    protected function getExtension()
=======
    protected function getExtension(): string
>>>>>>> main
    {
        return 'php';
    }
}
