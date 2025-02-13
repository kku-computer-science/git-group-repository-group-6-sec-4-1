<?php

/**
 * XHTML 1.1 Iframe Module provides inline frames.
 *
 * @note This module is not considered safe unless an Iframe
 * whitelisting mechanism is specified.  Currently, the only
 * such mechanism is %URL.SafeIframeRegexp
 */
class HTMLPurifier_HTMLModule_Iframe extends HTMLPurifier_HTMLModule
{

    /**
     * @type string
     */
    public $name = 'Iframe';

    /**
     * @type bool
     */
    public $safe = false;

    /**
     * @param HTMLPurifier_Config $config
     */
    public function setup($config)
    {
        if ($config->get('HTML.SafeIframe')) {
            $this->safe = true;
        }
<<<<<<< HEAD
=======
        $attrs = array(
            'src' => 'URI#embedded',
            'width' => 'Length',
            'height' => 'Length',
            'name' => 'ID',
            'scrolling' => 'Enum#yes,no,auto',
            'frameborder' => 'Enum#0,1',
            'longdesc' => 'URI',
            'marginheight' => 'Pixels',
            'marginwidth' => 'Pixels',
        );

        if ($config->get('HTML.Trusted')) {
            $attrs['allowfullscreen'] = 'Bool#allowfullscreen';
        }

>>>>>>> main
        $this->addElement(
            'iframe',
            'Inline',
            'Flow',
            'Common',
<<<<<<< HEAD
            array(
                'src' => 'URI#embedded',
                'width' => 'Length',
                'height' => 'Length',
                'name' => 'ID',
                'scrolling' => 'Enum#yes,no,auto',
                'frameborder' => 'Enum#0,1',
                'longdesc' => 'URI',
                'marginheight' => 'Pixels',
                'marginwidth' => 'Pixels',
            )
=======
            $attrs
>>>>>>> main
        );
    }
}

// vim: et sw=4 sts=4
