<?php

/**
 * Defines allowed CSS attributes and what their values are.
 * @see HTMLPurifier_HTMLDefinition
 */
class HTMLPurifier_CSSDefinition extends HTMLPurifier_Definition
{

    public $type = 'CSS';

    /**
     * Assoc array of attribute name to definition object.
     * @type HTMLPurifier_AttrDef[]
     */
<<<<<<< HEAD
    public $info = array();
=======
    public $info = [];
>>>>>>> main

    /**
     * Constructs the info array.  The meat of this class.
     * @param HTMLPurifier_Config $config
     */
    protected function doSetup($config)
    {
        $this->info['text-align'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array('left', 'right', 'center', 'justify'),
=======
            ['left', 'right', 'center', 'justify'],
>>>>>>> main
            false
        );

        $border_style =
            $this->info['border-bottom-style'] =
            $this->info['border-right-style'] =
            $this->info['border-left-style'] =
            $this->info['border-top-style'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
                array(
=======
                [
>>>>>>> main
                    'none',
                    'hidden',
                    'dotted',
                    'dashed',
                    'solid',
                    'double',
                    'groove',
                    'ridge',
                    'inset',
                    'outset'
<<<<<<< HEAD
                ),
=======
                ],
>>>>>>> main
                false
            );

        $this->info['border-style'] = new HTMLPurifier_AttrDef_CSS_Multiple($border_style);

        $this->info['clear'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array('none', 'left', 'right', 'both'),
            false
        );
        $this->info['float'] = new HTMLPurifier_AttrDef_Enum(
            array('none', 'left', 'right'),
            false
        );
        $this->info['font-style'] = new HTMLPurifier_AttrDef_Enum(
            array('normal', 'italic', 'oblique'),
            false
        );
        $this->info['font-variant'] = new HTMLPurifier_AttrDef_Enum(
            array('normal', 'small-caps'),
=======
            ['none', 'left', 'right', 'both'],
            false
        );
        $this->info['float'] = new HTMLPurifier_AttrDef_Enum(
            ['none', 'left', 'right'],
            false
        );
        $this->info['font-style'] = new HTMLPurifier_AttrDef_Enum(
            ['normal', 'italic', 'oblique'],
            false
        );
        $this->info['font-variant'] = new HTMLPurifier_AttrDef_Enum(
            ['normal', 'small-caps'],
>>>>>>> main
            false
        );

        $uri_or_none = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
            array(
                new HTMLPurifier_AttrDef_Enum(array('none')),
                new HTMLPurifier_AttrDef_CSS_URI()
            )
        );

        $this->info['list-style-position'] = new HTMLPurifier_AttrDef_Enum(
            array('inside', 'outside'),
            false
        );
        $this->info['list-style-type'] = new HTMLPurifier_AttrDef_Enum(
            array(
=======
            [
                new HTMLPurifier_AttrDef_Enum(['none']),
                new HTMLPurifier_AttrDef_CSS_URI()
            ]
        );

        $this->info['list-style-position'] = new HTMLPurifier_AttrDef_Enum(
            ['inside', 'outside'],
            false
        );
        $this->info['list-style-type'] = new HTMLPurifier_AttrDef_Enum(
            [
>>>>>>> main
                'disc',
                'circle',
                'square',
                'decimal',
                'lower-roman',
                'upper-roman',
                'lower-alpha',
                'upper-alpha',
                'none'
<<<<<<< HEAD
            ),
=======
            ],
>>>>>>> main
            false
        );
        $this->info['list-style-image'] = $uri_or_none;

        $this->info['list-style'] = new HTMLPurifier_AttrDef_CSS_ListStyle($config);

        $this->info['text-transform'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array('capitalize', 'uppercase', 'lowercase', 'none'),
=======
            ['capitalize', 'uppercase', 'lowercase', 'none'],
>>>>>>> main
            false
        );
        $this->info['color'] = new HTMLPurifier_AttrDef_CSS_Color();

        $this->info['background-image'] = $uri_or_none;
        $this->info['background-repeat'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array('repeat', 'repeat-x', 'repeat-y', 'no-repeat')
        );
        $this->info['background-attachment'] = new HTMLPurifier_AttrDef_Enum(
            array('scroll', 'fixed')
=======
            ['repeat', 'repeat-x', 'repeat-y', 'no-repeat']
        );
        $this->info['background-attachment'] = new HTMLPurifier_AttrDef_Enum(
            ['scroll', 'fixed']
>>>>>>> main
        );
        $this->info['background-position'] = new HTMLPurifier_AttrDef_CSS_BackgroundPosition();

        $this->info['background-size'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
            array(
                new HTMLPurifier_AttrDef_Enum(
                    array(
                        'auto',
                        'cover',
                        'contain',
                        'initial',
                        'inherit',
                    )
                ),
                new HTMLPurifier_AttrDef_CSS_Percentage(),
                new HTMLPurifier_AttrDef_CSS_Length()
            )
=======
            [
                new HTMLPurifier_AttrDef_Enum(
                    [
                        'auto',
                        'cover',
                        'contain',
                    ]
                ),
                new HTMLPurifier_AttrDef_CSS_Percentage(),
                new HTMLPurifier_AttrDef_CSS_Length()
            ]
>>>>>>> main
        );

        $border_color =
            $this->info['border-top-color'] =
            $this->info['border-bottom-color'] =
            $this->info['border-left-color'] =
            $this->info['border-right-color'] =
            $this->info['background-color'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
                array(
                    new HTMLPurifier_AttrDef_Enum(array('transparent')),
                    new HTMLPurifier_AttrDef_CSS_Color()
                )
=======
                [
                    new HTMLPurifier_AttrDef_Enum(['transparent']),
                    new HTMLPurifier_AttrDef_CSS_Color()
                ]
>>>>>>> main
            );

        $this->info['background'] = new HTMLPurifier_AttrDef_CSS_Background($config);

        $this->info['border-color'] = new HTMLPurifier_AttrDef_CSS_Multiple($border_color);

        $border_width =
            $this->info['border-top-width'] =
            $this->info['border-bottom-width'] =
            $this->info['border-left-width'] =
            $this->info['border-right-width'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
                array(
                    new HTMLPurifier_AttrDef_Enum(array('thin', 'medium', 'thick')),
                    new HTMLPurifier_AttrDef_CSS_Length('0') //disallow negative
                )
=======
                [
                    new HTMLPurifier_AttrDef_Enum(['thin', 'medium', 'thick']),
                    new HTMLPurifier_AttrDef_CSS_Length('0') //disallow negative
                ]
>>>>>>> main
            );

        $this->info['border-width'] = new HTMLPurifier_AttrDef_CSS_Multiple($border_width);

        $this->info['letter-spacing'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
            array(
                new HTMLPurifier_AttrDef_Enum(array('normal')),
                new HTMLPurifier_AttrDef_CSS_Length()
            )
        );

        $this->info['word-spacing'] = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_Enum(array('normal')),
                new HTMLPurifier_AttrDef_CSS_Length()
            )
        );

        $this->info['font-size'] = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_Enum(
                    array(
=======
            [
                new HTMLPurifier_AttrDef_Enum(['normal']),
                new HTMLPurifier_AttrDef_CSS_Length()
            ]
        );

        $this->info['word-spacing'] = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_Enum(['normal']),
                new HTMLPurifier_AttrDef_CSS_Length()
            ]
        );

        $this->info['font-size'] = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_Enum(
                    [
>>>>>>> main
                        'xx-small',
                        'x-small',
                        'small',
                        'medium',
                        'large',
                        'x-large',
                        'xx-large',
                        'larger',
                        'smaller'
<<<<<<< HEAD
                    )
                ),
                new HTMLPurifier_AttrDef_CSS_Percentage(),
                new HTMLPurifier_AttrDef_CSS_Length()
            )
        );

        $this->info['line-height'] = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_Enum(array('normal')),
                new HTMLPurifier_AttrDef_CSS_Number(true), // no negatives
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true)
            )
=======
                    ]
                ),
                new HTMLPurifier_AttrDef_CSS_Percentage(),
                new HTMLPurifier_AttrDef_CSS_Length()
            ]
        );

        $this->info['line-height'] = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_Enum(['normal']),
                new HTMLPurifier_AttrDef_CSS_Number(true), // no negatives
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true)
            ]
>>>>>>> main
        );

        $margin =
            $this->info['margin-top'] =
            $this->info['margin-bottom'] =
            $this->info['margin-left'] =
            $this->info['margin-right'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
                array(
                    new HTMLPurifier_AttrDef_CSS_Length(),
                    new HTMLPurifier_AttrDef_CSS_Percentage(),
                    new HTMLPurifier_AttrDef_Enum(array('auto'))
                )
=======
                [
                    new HTMLPurifier_AttrDef_CSS_Length(),
                    new HTMLPurifier_AttrDef_CSS_Percentage(),
                    new HTMLPurifier_AttrDef_Enum(['auto'])
                ]
>>>>>>> main
            );

        $this->info['margin'] = new HTMLPurifier_AttrDef_CSS_Multiple($margin);

        // non-negative
        $padding =
            $this->info['padding-top'] =
            $this->info['padding-bottom'] =
            $this->info['padding-left'] =
            $this->info['padding-right'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
                array(
                    new HTMLPurifier_AttrDef_CSS_Length('0'),
                    new HTMLPurifier_AttrDef_CSS_Percentage(true)
                )
=======
                [
                    new HTMLPurifier_AttrDef_CSS_Length('0'),
                    new HTMLPurifier_AttrDef_CSS_Percentage(true)
                ]
>>>>>>> main
            );

        $this->info['padding'] = new HTMLPurifier_AttrDef_CSS_Multiple($padding);

        $this->info['text-indent'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
            array(
                new HTMLPurifier_AttrDef_CSS_Length(),
                new HTMLPurifier_AttrDef_CSS_Percentage()
            )
        );

        $trusted_wh = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true),
                new HTMLPurifier_AttrDef_Enum(array('auto', 'initial', 'inherit'))
            )
        );
        $trusted_min_wh = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true),
                new HTMLPurifier_AttrDef_Enum(array('initial', 'inherit'))
            )
        );
        $trusted_max_wh = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true),
                new HTMLPurifier_AttrDef_Enum(array('none', 'initial', 'inherit'))
            )
=======
            [
                new HTMLPurifier_AttrDef_CSS_Length(),
                new HTMLPurifier_AttrDef_CSS_Percentage()
            ]
        );

        $trusted_wh = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true),
                new HTMLPurifier_AttrDef_Enum(['auto'])
            ]
        );
        $trusted_min_wh = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true),
            ]
        );
        $trusted_max_wh = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_CSS_Length('0'),
                new HTMLPurifier_AttrDef_CSS_Percentage(true),
                new HTMLPurifier_AttrDef_Enum(['none'])
            ]
>>>>>>> main
        );
        $max = $config->get('CSS.MaxImgLength');

        $this->info['width'] =
        $this->info['height'] =
            $max === null ?
                $trusted_wh :
                new HTMLPurifier_AttrDef_Switch(
                    'img',
                    // For img tags:
                    new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
                        array(
                            new HTMLPurifier_AttrDef_CSS_Length('0', $max),
                            new HTMLPurifier_AttrDef_Enum(array('auto'))
                        )
=======
                        [
                            new HTMLPurifier_AttrDef_CSS_Length('0', $max),
                            new HTMLPurifier_AttrDef_Enum(['auto'])
                        ]
>>>>>>> main
                    ),
                    // For everyone else:
                    $trusted_wh
                );
        $this->info['min-width'] =
        $this->info['min-height'] =
            $max === null ?
                $trusted_min_wh :
                new HTMLPurifier_AttrDef_Switch(
                    'img',
                    // For img tags:
<<<<<<< HEAD
                    new HTMLPurifier_AttrDef_CSS_Composite(
                        array(
                            new HTMLPurifier_AttrDef_CSS_Length('0', $max),
                            new HTMLPurifier_AttrDef_Enum(array('initial', 'inherit'))
                        )
                    ),
=======
                    new HTMLPurifier_AttrDef_CSS_Length('0', $max),
>>>>>>> main
                    // For everyone else:
                    $trusted_min_wh
                );
        $this->info['max-width'] =
        $this->info['max-height'] =
            $max === null ?
                $trusted_max_wh :
                new HTMLPurifier_AttrDef_Switch(
                    'img',
                    // For img tags:
                    new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
                        array(
                            new HTMLPurifier_AttrDef_CSS_Length('0', $max),
                            new HTMLPurifier_AttrDef_Enum(array('none', 'initial', 'inherit'))
                        )
=======
                        [
                            new HTMLPurifier_AttrDef_CSS_Length('0', $max),
                            new HTMLPurifier_AttrDef_Enum(['none'])
                        ]
>>>>>>> main
                    ),
                    // For everyone else:
                    $trusted_max_wh
                );

<<<<<<< HEAD
        $this->info['text-decoration'] = new HTMLPurifier_AttrDef_CSS_TextDecoration();

=======
        $this->info['aspect-ratio'] = new HTMLPurifier_AttrDef_CSS_Multiple(
            new HTMLPurifier_AttrDef_CSS_Composite([
                new HTMLPurifier_AttrDef_CSS_Ratio(),
                new HTMLPurifier_AttrDef_Enum(['auto']),
            ])
        );

        // text-decoration and related shorthands
        $this->info['text-decoration'] = new HTMLPurifier_AttrDef_CSS_TextDecoration();

        $this->info['text-decoration-line'] = new HTMLPurifier_AttrDef_Enum(
            ['none', 'underline', 'overline', 'line-through']
        );

        $this->info['text-decoration-style'] = new HTMLPurifier_AttrDef_Enum(
            ['solid', 'double', 'dotted', 'dashed', 'wavy']
        );

        $this->info['text-decoration-color'] = new HTMLPurifier_AttrDef_CSS_Color();

        $this->info['text-decoration-thickness'] = new HTMLPurifier_AttrDef_CSS_Composite([
            new HTMLPurifier_AttrDef_CSS_Length(),
            new HTMLPurifier_AttrDef_CSS_Percentage(),
            new HTMLPurifier_AttrDef_Enum(['auto', 'from-font'])
        ]);

>>>>>>> main
        $this->info['font-family'] = new HTMLPurifier_AttrDef_CSS_FontFamily();

        // this could use specialized code
        $this->info['font-weight'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array(
=======
            [
>>>>>>> main
                'normal',
                'bold',
                'bolder',
                'lighter',
                '100',
                '200',
                '300',
                '400',
                '500',
                '600',
                '700',
                '800',
                '900'
<<<<<<< HEAD
            ),
=======
            ],
>>>>>>> main
            false
        );

        // MUST be called after other font properties, as it references
        // a CSSDefinition object
        $this->info['font'] = new HTMLPurifier_AttrDef_CSS_Font($config);

        // same here
        $this->info['border'] =
        $this->info['border-bottom'] =
        $this->info['border-top'] =
        $this->info['border-left'] =
        $this->info['border-right'] = new HTMLPurifier_AttrDef_CSS_Border($config);

        $this->info['border-collapse'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array('collapse', 'separate')
        );

        $this->info['caption-side'] = new HTMLPurifier_AttrDef_Enum(
            array('top', 'bottom')
        );

        $this->info['table-layout'] = new HTMLPurifier_AttrDef_Enum(
            array('auto', 'fixed')
        );

        $this->info['vertical-align'] = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_Enum(
                    array(
=======
            ['collapse', 'separate']
        );

        $this->info['caption-side'] = new HTMLPurifier_AttrDef_Enum(
            ['top', 'bottom']
        );

        $this->info['table-layout'] = new HTMLPurifier_AttrDef_Enum(
            ['auto', 'fixed']
        );

        $this->info['vertical-align'] = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_Enum(
                    [
>>>>>>> main
                        'baseline',
                        'sub',
                        'super',
                        'top',
                        'text-top',
                        'middle',
                        'bottom',
                        'text-bottom'
<<<<<<< HEAD
                    )
                ),
                new HTMLPurifier_AttrDef_CSS_Length(),
                new HTMLPurifier_AttrDef_CSS_Percentage()
            )
=======
                    ]
                ),
                new HTMLPurifier_AttrDef_CSS_Length(),
                new HTMLPurifier_AttrDef_CSS_Percentage()
            ]
>>>>>>> main
        );

        $this->info['border-spacing'] = new HTMLPurifier_AttrDef_CSS_Multiple(new HTMLPurifier_AttrDef_CSS_Length(), 2);

        // These CSS properties don't work on many browsers, but we live
        // in THE FUTURE!
        $this->info['white-space'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array('nowrap', 'normal', 'pre', 'pre-wrap', 'pre-line')
=======
            ['nowrap', 'normal', 'pre', 'pre-wrap', 'pre-line']
>>>>>>> main
        );

        if ($config->get('CSS.Proprietary')) {
            $this->doSetupProprietary($config);
        }

        if ($config->get('CSS.AllowTricky')) {
            $this->doSetupTricky($config);
        }

        if ($config->get('CSS.Trusted')) {
            $this->doSetupTrusted($config);
        }

        $allow_important = $config->get('CSS.AllowImportant');
        // wrap all attr-defs with decorator that handles !important
        foreach ($this->info as $k => $v) {
            $this->info[$k] = new HTMLPurifier_AttrDef_CSS_ImportantDecorator($v, $allow_important);
        }

        $this->setupConfigStuff($config);
    }

    /**
     * @param HTMLPurifier_Config $config
     */
    protected function doSetupProprietary($config)
    {
        // Internet Explorer only scrollbar colors
        $this->info['scrollbar-arrow-color'] = new HTMLPurifier_AttrDef_CSS_Color();
        $this->info['scrollbar-base-color'] = new HTMLPurifier_AttrDef_CSS_Color();
        $this->info['scrollbar-darkshadow-color'] = new HTMLPurifier_AttrDef_CSS_Color();
        $this->info['scrollbar-face-color'] = new HTMLPurifier_AttrDef_CSS_Color();
        $this->info['scrollbar-highlight-color'] = new HTMLPurifier_AttrDef_CSS_Color();
        $this->info['scrollbar-shadow-color'] = new HTMLPurifier_AttrDef_CSS_Color();

        // vendor specific prefixes of opacity
        $this->info['-moz-opacity'] = new HTMLPurifier_AttrDef_CSS_AlphaValue();
        $this->info['-khtml-opacity'] = new HTMLPurifier_AttrDef_CSS_AlphaValue();

        // only opacity, for now
        $this->info['filter'] = new HTMLPurifier_AttrDef_CSS_Filter();

        // more CSS3
        $this->info['page-break-after'] =
        $this->info['page-break-before'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array(
=======
            [
>>>>>>> main
                'auto',
                'always',
                'avoid',
                'left',
                'right'
<<<<<<< HEAD
            )
        );
        $this->info['page-break-inside'] = new HTMLPurifier_AttrDef_Enum(array('auto', 'avoid'));

        $border_radius = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_CSS_Percentage(true), // disallow negative
                new HTMLPurifier_AttrDef_CSS_Length('0') // disallow negative
            ));
=======
            ]
        );
        $this->info['page-break-inside'] = new HTMLPurifier_AttrDef_Enum(['auto', 'avoid']);

        $border_radius = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_CSS_Percentage(true), // disallow negative
                new HTMLPurifier_AttrDef_CSS_Length('0') // disallow negative
            ]);
>>>>>>> main

        $this->info['border-top-left-radius'] =
        $this->info['border-top-right-radius'] =
        $this->info['border-bottom-right-radius'] =
        $this->info['border-bottom-left-radius'] = new HTMLPurifier_AttrDef_CSS_Multiple($border_radius, 2);
        // TODO: support SLASH syntax
        $this->info['border-radius'] = new HTMLPurifier_AttrDef_CSS_Multiple($border_radius, 4);

    }

    /**
     * @param HTMLPurifier_Config $config
     */
    protected function doSetupTricky($config)
    {
        $this->info['display'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array(
=======
            [
>>>>>>> main
                'inline',
                'block',
                'list-item',
                'run-in',
                'compact',
                'marker',
                'table',
                'inline-block',
                'inline-table',
                'table-row-group',
                'table-header-group',
                'table-footer-group',
                'table-row',
                'table-column-group',
                'table-column',
                'table-cell',
                'table-caption',
                'none'
<<<<<<< HEAD
            )
        );
        $this->info['visibility'] = new HTMLPurifier_AttrDef_Enum(
            array('visible', 'hidden', 'collapse')
        );
        $this->info['overflow'] = new HTMLPurifier_AttrDef_Enum(array('visible', 'hidden', 'auto', 'scroll'));
=======
            ]
        );
        $this->info['visibility'] = new HTMLPurifier_AttrDef_Enum(
            ['visible', 'hidden', 'collapse']
        );
        $this->info['overflow'] = new HTMLPurifier_AttrDef_Enum(['visible', 'hidden', 'auto', 'scroll']);
>>>>>>> main
        $this->info['opacity'] = new HTMLPurifier_AttrDef_CSS_AlphaValue();
    }

    /**
     * @param HTMLPurifier_Config $config
     */
    protected function doSetupTrusted($config)
    {
        $this->info['position'] = new HTMLPurifier_AttrDef_Enum(
<<<<<<< HEAD
            array('static', 'relative', 'absolute', 'fixed')
=======
            ['static', 'relative', 'absolute', 'fixed']
>>>>>>> main
        );
        $this->info['top'] =
        $this->info['left'] =
        $this->info['right'] =
        $this->info['bottom'] = new HTMLPurifier_AttrDef_CSS_Composite(
<<<<<<< HEAD
            array(
                new HTMLPurifier_AttrDef_CSS_Length(),
                new HTMLPurifier_AttrDef_CSS_Percentage(),
                new HTMLPurifier_AttrDef_Enum(array('auto')),
            )
        );
        $this->info['z-index'] = new HTMLPurifier_AttrDef_CSS_Composite(
            array(
                new HTMLPurifier_AttrDef_Integer(),
                new HTMLPurifier_AttrDef_Enum(array('auto')),
            )
=======
            [
                new HTMLPurifier_AttrDef_CSS_Length(),
                new HTMLPurifier_AttrDef_CSS_Percentage(),
                new HTMLPurifier_AttrDef_Enum(['auto']),
            ]
        );
        $this->info['z-index'] = new HTMLPurifier_AttrDef_CSS_Composite(
            [
                new HTMLPurifier_AttrDef_Integer(),
                new HTMLPurifier_AttrDef_Enum(['auto']),
            ]
>>>>>>> main
        );
    }

    /**
     * Performs extra config-based processing. Based off of
     * HTMLPurifier_HTMLDefinition.
     * @param HTMLPurifier_Config $config
     * @todo Refactor duplicate elements into common class (probably using
     *       composition, not inheritance).
     */
    protected function setupConfigStuff($config)
    {
        // setup allowed elements
        $support = "(for information on implementing this, see the " .
            "support forums) ";
        $allowed_properties = $config->get('CSS.AllowedProperties');
        if ($allowed_properties !== null) {
            foreach ($this->info as $name => $d) {
                if (!isset($allowed_properties[$name])) {
                    unset($this->info[$name]);
                }
                unset($allowed_properties[$name]);
            }
            // emit errors
            foreach ($allowed_properties as $name => $d) {
                // :TODO: Is this htmlspecialchars() call really necessary?
                $name = htmlspecialchars($name);
                trigger_error("Style attribute '$name' is not supported $support", E_USER_WARNING);
            }
        }

        $forbidden_properties = $config->get('CSS.ForbiddenProperties');
        if ($forbidden_properties !== null) {
            foreach ($this->info as $name => $d) {
                if (isset($forbidden_properties[$name])) {
                    unset($this->info[$name]);
                }
            }
        }
    }
}

// vim: et sw=4 sts=4
