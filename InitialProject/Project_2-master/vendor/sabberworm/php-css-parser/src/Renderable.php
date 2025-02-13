<?php

namespace Sabberworm\CSS;

interface Renderable
{
    /**
     * @return string
     */
    public function __toString();

    /**
<<<<<<< HEAD
     * @return string
     */
    public function render(OutputFormat $oOutputFormat);
=======
     * @param OutputFormat|null $oOutputFormat
     *
     * @return string
     */
    public function render($oOutputFormat);
>>>>>>> main

    /**
     * @return int
     */
    public function getLineNo();
}
