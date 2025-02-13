<?php

namespace Sabberworm\CSS;

/**
 * Parser settings class.
 *
 * Configure parser behaviour here.
 */
class Settings
{
    /**
     * Multi-byte string support.
<<<<<<< HEAD
     * If true (mbstring extension must be enabled), will use (slower) `mb_strlen`, `mb_convert_case`, `mb_substr`
=======
     *
     * If `true` (`mbstring` extension must be enabled), will use (slower) `mb_strlen`, `mb_convert_case`, `mb_substr`
>>>>>>> main
     * and `mb_strpos` functions. Otherwise, the normal (ASCII-Only) functions will be used.
     *
     * @var bool
     */
    public $bMultibyteSupport;

    /**
<<<<<<< HEAD
     * The default charset for the CSS if no `@charset` rule is found. Defaults to utf-8.
=======
     * The default charset for the CSS if no `@charset` declaration is found. Defaults to utf-8.
>>>>>>> main
     *
     * @var string
     */
    public $sDefaultCharset = 'utf-8';

    /**
<<<<<<< HEAD
     * Lenient parsing. When used (which is true by default), the parser will not choke
     * on unexpected tokens but simply ignore them.
=======
     * Whether the parser silently ignore invalid rules instead of choking on them.
>>>>>>> main
     *
     * @var bool
     */
    public $bLenientParsing = true;

    private function __construct()
    {
        $this->bMultibyteSupport = extension_loaded('mbstring');
    }

    /**
     * @return self new instance
     */
    public static function create()
    {
        return new Settings();
    }

    /**
<<<<<<< HEAD
=======
     * Enables/disables multi-byte string support.
     *
     * If `true` (`mbstring` extension must be enabled), will use (slower) `mb_strlen`, `mb_convert_case`, `mb_substr`
     * and `mb_strpos` functions. Otherwise, the normal (ASCII-Only) functions will be used.
     *
>>>>>>> main
     * @param bool $bMultibyteSupport
     *
     * @return self fluent interface
     */
    public function withMultibyteSupport($bMultibyteSupport = true)
    {
        $this->bMultibyteSupport = $bMultibyteSupport;
        return $this;
    }

    /**
<<<<<<< HEAD
=======
     * Sets the charset to be used if the CSS does not contain an `@charset` declaration.
     *
>>>>>>> main
     * @param string $sDefaultCharset
     *
     * @return self fluent interface
     */
    public function withDefaultCharset($sDefaultCharset)
    {
        $this->sDefaultCharset = $sDefaultCharset;
        return $this;
    }

    /**
<<<<<<< HEAD
=======
     * Configures whether the parser should silently ignore invalid rules.
     *
>>>>>>> main
     * @param bool $bLenientParsing
     *
     * @return self fluent interface
     */
    public function withLenientParsing($bLenientParsing = true)
    {
        $this->bLenientParsing = $bLenientParsing;
        return $this;
    }

    /**
<<<<<<< HEAD
=======
     * Configures the parser to choke on invalid rules.
     *
>>>>>>> main
     * @return self fluent interface
     */
    public function beStrict()
    {
        return $this->withLenientParsing(false);
    }
}
