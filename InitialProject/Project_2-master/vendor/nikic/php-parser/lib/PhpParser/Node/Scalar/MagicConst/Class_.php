<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar\MagicConst;

use PhpParser\Node\Scalar\MagicConst;

<<<<<<< HEAD
class Class_ extends MagicConst
{
    public function getName() : string {
        return '__CLASS__';
    }
    
    public function getType() : string {
=======
class Class_ extends MagicConst {
    public function getName(): string {
        return '__CLASS__';
    }

    public function getType(): string {
>>>>>>> main
        return 'Scalar_MagicConst_Class';
    }
}
