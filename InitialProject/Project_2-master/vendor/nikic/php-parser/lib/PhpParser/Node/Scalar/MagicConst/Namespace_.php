<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar\MagicConst;

use PhpParser\Node\Scalar\MagicConst;

<<<<<<< HEAD
class Namespace_ extends MagicConst
{
    public function getName() : string {
        return '__NAMESPACE__';
    }
    
    public function getType() : string {
=======
class Namespace_ extends MagicConst {
    public function getName(): string {
        return '__NAMESPACE__';
    }

    public function getType(): string {
>>>>>>> main
        return 'Scalar_MagicConst_Namespace';
    }
}
