<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Turkish;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;

class Inflectible
{
<<<<<<< HEAD
    /**
     * @return Transformation[]
     */
=======
    /** @return Transformation[] */
>>>>>>> main
    public static function getSingular(): iterable
    {
        yield new Transformation(new Pattern('/l[ae]r$/i'), '');
    }

<<<<<<< HEAD
    /**
     * @return Transformation[]
     */
=======
    /** @return Transformation[] */
>>>>>>> main
    public static function getPlural(): iterable
    {
        yield new Transformation(new Pattern('/([eöiü][^aoıueöiü]{0,6})$/u'), '\1ler');
        yield new Transformation(new Pattern('/([aoıu][^aoıueöiü]{0,6})$/u'), '\1lar');
    }

<<<<<<< HEAD
    /**
     * @return Substitution[]
     */
=======
    /** @return Substitution[] */
>>>>>>> main
    public static function getIrregular(): iterable
    {
        yield new Substitution(new Word('ben'), new Word('biz'));
        yield new Substitution(new Word('sen'), new Word('siz'));
        yield new Substitution(new Word('o'), new Word('onlar'));
    }
}
