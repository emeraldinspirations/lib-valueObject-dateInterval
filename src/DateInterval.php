<?php

/**
 * Container for an extension of the DateInterval object
 *
 * PHP Version 7
 *
 * @category  Libray
 * @package   ValueObject-DateInterval
 * @author    Matthew "Juniper" Barlett <emeraldinspirations@gmail.com>
 * @copyright 2017 Matthew "Juniper" Barlett <emeraldinspirations@gmail.com>
 * @license   TBD ../LICENSE.md
 * @link      https://github.com/emeraldinspirations/lib-valueObject-dateInterval
 */

namespace emeraldinspirations\library\valueObject;

/**
 * An extension of the DateInterval object
 *
 * @category  Libray
 * @package   ValueObject-DateInterval
 * @author    Matthew "Juniper" Barlett <emeraldinspirations@gmail.com>
 * @copyright 2017 Matthew "Juniper" Barlett <emeraldinspirations@gmail.com>
 * @license   TBD ../LICENSE.md
 * @version   GIT: $Id: f627306671268e7a24c3809def44b16abd93065a $ In Development.
 * @link      https://github.com/emeraldinspirations/lib-valueObject-dateInterval
 */
class DateInterval extends \DateInterval
{

    /**
     * Return interval specification
     *
     * @return string
     */
    public function toString()
    {

        $Function = function (string $Preface, array $Data) : string {

            // Remove any elements with a value of `0` or `null`
            $FilteredData = array_filter($Data);

            // If no elements remain, return zero-length string
            if (count($FilteredData) == 0) {
                return '';
            }

            // Append key to respective values ( ex: 'M'=>12 becomes 'M'=>12M )
            foreach ($FilteredData as $Key => &$Value) {
                $Value = $Value . $Key;
            }

            // Prepend preface to values, return results
            return $Preface . implode($FilteredData);

        };

        return 'P'
            . $Function(
                '', ['Y' => $this->y, 'M' => $this->m, 'D' => $this->d]
            )
            . $Function(
                'T', ['H' => $this->h, 'M' => $this->i, 'S' => $this->s]
            );

    }

    /**
     * Return interval specification
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Return if supplied value object has the same value
     *
     * @param self $Object object to compare
     *
     * @return bool
     */
    public function equals(self $Object)
    {
        foreach (['y', 'm', 'd', 'h', 'i', 's'] as $Magnatude) {
            if (($this->$Magnatude <=> $Object->$Magnatude) !== 0) {
                return false;
            }
        }
        return true;
    }

}
