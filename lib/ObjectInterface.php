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

/**
 * Interface ObjectInterface
 *
 * @author  Derek J. Lambert <dlambert@dereklambert.com>
 * @license http://dlambert.mit-license.org MIT
 */
interface ObjectInterface
{
    //TODO: add remaining types
    const T_POINT              = 'Point';
    const T_LINESTRING         = 'LineString';
    const T_POLYGON            = 'Polygon';
    const T_MULTIPOINT         = 'MultiPoint';
    const T_MULTILINESTRING    = 'MultiLineString';
    const T_MULTIPOLYGON       = 'MultiPolygon';
    const T_GEOMETRYCOLLECTION = 'GeometryCollection';
    const T_CIRCULARSTRING     = 'CircularString';
    const T_FEATURE            = 'Feature';
    const T_FEATURECOLLECTION  = 'FeatureCollection';

    /**
     * @return string Object type name, should also be value of a interface constant TODO lowercase?
     */
    public function getType();
}