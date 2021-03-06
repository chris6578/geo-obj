<?php
/**
 * Copyright (C) 2016 Derek J. Lambert
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace CrEOF\Geo\Obj;

use CrEOF\Geo\Obj\Exception\UnexpectedValueException;
use CrEOF\Geo\Obj\Exception\UnknownTypeException;
use CrEOF\Geo\Obj\Traits\Singleton;
use CrEOF\Geo\Obj\Validator\TypeValidator;
use CrEOF\Geo\Obj\Validator\ValidatorInterface;
use CrEOF\Geo\Obj\Validator\ValidatorStack;
use ReflectionClass;

/**
 * Class Configuration
 *
 * @author  Derek J. Lambert <dlambert@dereklambert.com>
 * @license http://dlambert.mit-license.org MIT
 */
final class Configuration
{
    use Singleton;

    /**
     * @var ValidatorStack[]
     */
    private $validators;

    private function __construct()
    {
        $reflectionClass = new ReflectionClass('CrEOF\Geo\Obj\Object');

        foreach ($reflectionClass->getConstants() as $value) {
            if (null === $value) {
                continue;
            }

            $validatorStack      = new ValidatorStack();
            $valueValidatorClass = 'CrEOF\Geo\Obj\Validator\Data\\' . $value . 'Validator';

            $validatorStack->push(new TypeValidator($value));
            $validatorStack->push(new $valueValidatorClass());

            $this->validators[ObjectFactory::getTypeClass($value)] = $validatorStack;
        }
    }

    /**
     * @param string             $type
     * @param ValidatorInterface $validator
     *
     * @throws UnexpectedValueException
     * @throws UnknownTypeException
     */
    public function pushValidator($type, ValidatorInterface $validator)
    {
        $this->validators[ObjectFactory::getTypeClass($type)]->push($validator);
    }

    /**
     * @param string $type
     *
     * @return ValidatorStack
     *
     * @throws UnknownTypeException
     */
    public function getValidatorStack($type)
    {
        //TODO does this really need clone, or let people do stupid things?
        return clone $this->validators[ObjectFactory::getTypeClass($type)];
    }
}
