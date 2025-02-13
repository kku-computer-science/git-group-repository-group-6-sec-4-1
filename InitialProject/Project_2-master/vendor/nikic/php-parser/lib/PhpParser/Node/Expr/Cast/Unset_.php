<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\Cast;

use PhpParser\Node\Expr\Cast;

<<<<<<< HEAD
class Unset_ extends Cast
{
    public function getType() : string {
=======
class Unset_ extends Cast {
    public function getType(): string {
>>>>>>> main
        return 'Expr_Cast_Unset';
    }
}
