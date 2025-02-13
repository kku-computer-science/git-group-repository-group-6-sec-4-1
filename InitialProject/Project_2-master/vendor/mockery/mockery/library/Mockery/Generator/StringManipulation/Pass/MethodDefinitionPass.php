<?php
<<<<<<< HEAD
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
=======

/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
>>>>>>> main
 */

namespace Mockery\Generator\StringManipulation\Pass;

use Mockery\Generator\Method;
<<<<<<< HEAD
use Mockery\Generator\Parameter;
use Mockery\Generator\MockConfiguration;

class MethodDefinitionPass implements Pass
{
=======
use Mockery\Generator\MockConfiguration;
use Mockery\Generator\Parameter;
use function array_values;
use function count;
use function enum_exists;
use function get_class;
use function implode;
use function in_array;
use function is_object;
use function preg_match;
use function sprintf;
use function strpos;
use function strrpos;
use function strtolower;
use function substr;
use function var_export;
use const PHP_VERSION_ID;

class MethodDefinitionPass implements Pass
{
    /**
     * @param  string $code
     * @return string
     */
>>>>>>> main
    public function apply($code, MockConfiguration $config)
    {
        foreach ($config->getMethodsToMock() as $method) {
            if ($method->isPublic()) {
                $methodDef = 'public';
            } elseif ($method->isProtected()) {
                $methodDef = 'protected';
            } else {
                $methodDef = 'private';
            }

            if ($method->isStatic()) {
                $methodDef .= ' static';
            }

            $methodDef .= ' function ';
            $methodDef .= $method->returnsReference() ? ' & ' : '';
            $methodDef .= $method->getName();
            $methodDef .= $this->renderParams($method, $config);
            $methodDef .= $this->renderReturnType($method);
            $methodDef .= $this->renderMethodBody($method, $config);

            $code = $this->appendToClass($code, $methodDef);
        }

        return $code;
    }

<<<<<<< HEAD
=======
    protected function appendToClass($class, $code)
    {
        $lastBrace = strrpos($class, '}');
        return substr($class, 0, $lastBrace) . $code . "\n    }\n";
    }

>>>>>>> main
    protected function renderParams(Method $method, $config)
    {
        $class = $method->getDeclaringClass();
        if ($class->isInternal()) {
            $overrides = $config->getParameterOverrides();

            if (isset($overrides[strtolower($class->getName())][$method->getName()])) {
                return '(' . implode(',', $overrides[strtolower($class->getName())][$method->getName()]) . ')';
            }
        }

<<<<<<< HEAD
        $methodParams = array();
        $params = $method->getParameters();
=======
        $methodParams = [];
        $params = $method->getParameters();
        $isPhp81 = PHP_VERSION_ID >= 80100;
>>>>>>> main
        foreach ($params as $param) {
            $paramDef = $this->renderTypeHint($param);
            $paramDef .= $param->isPassedByReference() ? '&' : '';
            $paramDef .= $param->isVariadic() ? '...' : '';
            $paramDef .= '$' . $param->getName();

<<<<<<< HEAD
            if (!$param->isVariadic()) {
                if (false !== $param->isDefaultValueAvailable()) {
                    $defaultValue = $param->getDefaultValue();
                    $paramDef .= ' = ' . (is_object($defaultValue) ? get_class($defaultValue) : var_export($defaultValue, true));
=======
            if (! $param->isVariadic()) {
                if ($param->isDefaultValueAvailable() !== false) {
                    $defaultValue = $param->getDefaultValue();

                    if (is_object($defaultValue)) {
                        $prefix = get_class($defaultValue);
                        if ($isPhp81) {
                            if (enum_exists($prefix)) {
                                $prefix = var_export($defaultValue, true);
                            } elseif (
                                ! $param->isDefaultValueConstant() &&
                                // "Parameter #1 [ <optional> F\Q\CN $a = new \F\Q\CN(param1, param2: 2) ]
                                preg_match(
                                    '#<optional>\s.*?\s=\snew\s(.*?)\s]$#',
                                    $param->__toString(),
                                    $matches
                                ) === 1
                            ) {
                                $prefix = 'new ' . $matches[1];
                            }
                        }
                    } else {
                        $prefix = var_export($defaultValue, true);
                    }

                    $paramDef .= ' = ' . $prefix;
>>>>>>> main
                } elseif ($param->isOptional()) {
                    $paramDef .= ' = null';
                }
            }

            $methodParams[] = $paramDef;
        }
<<<<<<< HEAD
=======

>>>>>>> main
        return '(' . implode(', ', $methodParams) . ')';
    }

    protected function renderReturnType(Method $method)
    {
        $type = $method->getReturnType();

        return $type ? sprintf(': %s', $type) : '';
    }

<<<<<<< HEAD
    protected function appendToClass($class, $code)
    {
        $lastBrace = strrpos($class, "}");
        $class = substr($class, 0, $lastBrace) . $code . "\n    }\n";
        return $class;
    }

=======
>>>>>>> main
    protected function renderTypeHint(Parameter $param)
    {
        $typeHint = $param->getTypeHint();

        return $typeHint === null ? '' : sprintf('%s ', $typeHint);
    }

    private function renderMethodBody($method, $config)
    {
        $invoke = $method->isStatic() ? 'static::_mockery_handleStaticMethodCall' : '$this->_mockery_handleMethodCall';
        $body = <<<BODY
{
\$argc = func_num_args();
\$argv = func_get_args();

BODY;

        // Fix up known parameters by reference - used func_get_args() above
        // in case more parameters are passed in than the function definition
        // says - eg varargs.
        $class = $method->getDeclaringClass();
        $class_name = strtolower($class->getName());
        $overrides = $config->getParameterOverrides();
        if (isset($overrides[$class_name][$method->getName()])) {
            $params = array_values($overrides[$class_name][$method->getName()]);
            $paramCount = count($params);
            for ($i = 0; $i < $paramCount; ++$i) {
                $param = $params[$i];
                if (strpos($param, '&') !== false) {
                    $body .= <<<BODY
<<<<<<< HEAD
if (\$argc > $i) {
    \$argv[$i] = {$param};
=======
if (\$argc > {$i}) {
    \$argv[{$i}] = {$param};
>>>>>>> main
}

BODY;
                }
            }
        } else {
            $params = array_values($method->getParameters());
            $paramCount = count($params);
            for ($i = 0; $i < $paramCount; ++$i) {
                $param = $params[$i];
<<<<<<< HEAD
                if (!$param->isPassedByReference()) {
                    continue;
                }
                $body .= <<<BODY
if (\$argc > $i) {
    \$argv[$i] =& \${$param->getName()};
=======
                if (! $param->isPassedByReference()) {
                    continue;
                }

                $body .= <<<BODY
if (\$argc > {$i}) {
    \$argv[{$i}] =& \${$param->getName()};
>>>>>>> main
}

BODY;
            }
        }

        $body .= "\$ret = {$invoke}(__FUNCTION__, \$argv);\n";

<<<<<<< HEAD
        if ($method->getReturnType() !== "void") {
            $body .= "return \$ret;\n";
        }

        $body .= "}\n";
        return $body;
=======
        if (! in_array($method->getReturnType(), ['never', 'void'], true)) {
            $body .= "return \$ret;\n";
        }

        return $body . "}\n";
>>>>>>> main
    }
}
