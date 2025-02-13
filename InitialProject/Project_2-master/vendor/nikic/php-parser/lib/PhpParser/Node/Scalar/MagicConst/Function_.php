<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar\MagicConst;

use PhpParser\Node\Scalar\MagicConst;

<<<<<<< HEAD
class Function_ extends MagicConst
{
    public function getName() : string {
        return '__FUNCTION__';
    }
    
    public function getType() : string {
=======
class Function_ extends MagicConst {
    public function getName(): string {
        return '__FUNCTION__';
    }

    public function getType(): string {
>>>>>>> main
        return 'Scalar_MagicConst_Function';
    }
}
