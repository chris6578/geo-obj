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

namespace CrEOF\Geo\Obj\Data\Generator;

use CrEOF\Geo\Obj\Exception\UnexpectedValueException;
use CrEOF\Geo\Obj\Exception\UnsupportedFormatException;
use CrEOF\Geo\WKB\Parser;

/**
 * Class WKB
 *
 * @author  Derek J. Lambert <dlambert@dereklambert.com>
 * @license http://dlambert.mit-license.org MIT
 */
class WKB implements GeneratorInterface
{
    /**
     * @var Parser
     */
    private static $parser;

    /**
     * WKB constructor
     */
    public function __construct()
    {
        if (null === self::$parser) {
            self::$parser = new Parser();
        }
    }

    /**
     * @param mixed       $value
     * @param null|string $typeHint
     *
     * @return array
     * @throws UnexpectedValueException
     * @throws UnsupportedFormatException
     */
    public function generate($value, $typeHint = null)
    {
        if (! is_string($value) || ord($value[0]) > 1) {
            throw new UnsupportedFormatException();
        }

        try {
            return self::$parser->parse($value);
        } catch (\CrEOF\Geo\WKB\Exception\UnexpectedValueException $e) {
            throw new UnexpectedValueException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
