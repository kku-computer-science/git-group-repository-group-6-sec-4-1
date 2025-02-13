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
 * CsvFileDumper generates a csv formatted string representation of a message catalogue.
 *
 * @author Stealth35
 */
class CsvFileDumper extends FileDumper
{
<<<<<<< HEAD
    private $delimiter = ';';
    private $enclosure = '"';

    /**
     * {@inheritdoc}
     */
    public function formatCatalogue(MessageCatalogue $messages, string $domain, array $options = [])
=======
    private string $delimiter = ';';
    private string $enclosure = '"';

    public function formatCatalogue(MessageCatalogue $messages, string $domain, array $options = []): string
>>>>>>> main
    {
        $handle = fopen('php://memory', 'r+');

        foreach ($messages->all($domain) as $source => $target) {
<<<<<<< HEAD
            fputcsv($handle, [$source, $target], $this->delimiter, $this->enclosure);
=======
            fputcsv($handle, [$source, $target], $this->delimiter, $this->enclosure, '\\');
>>>>>>> main
        }

        rewind($handle);
        $output = stream_get_contents($handle);
        fclose($handle);

        return $output;
    }

    /**
     * Sets the delimiter and escape character for CSV.
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> main
     */
    public function setCsvControl(string $delimiter = ';', string $enclosure = '"')
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
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
        return 'csv';
    }
}
