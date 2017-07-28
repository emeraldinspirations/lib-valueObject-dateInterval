<?php

/**
 * Container for unit tests for an extension of the DateInterval object
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

namespace emeraldinspirations\library\valueObject\dateInterval;

/**
 * Unit tests for an extension of the DateInterval object
 *
 * @category  Libray
 * @package   ValueObject-DateInterval
 * @author    Matthew "Juniper" Barlett <emeraldinspirations@gmail.com>
 * @copyright 2017 Matthew "Juniper" Barlett <emeraldinspirations@gmail.com>
 * @license   TBD ../LICENSE.md
 * @version   GIT: $Id: f627306671268e7a24c3809def44b16abd93065a $ In Development.
 * @link      https://github.com/emeraldinspirations/lib-valueObject-dateInterval
 */
class DateIntervalTest extends \PHPUnit_Framework_TestCase
{

    protected $Object;

    /**
     * Run before each test
     *
     * @return void
     */
    public function setUp()
    {

        $this->Object = new DateInterval('P1D');

    }

    /**
     * Verify object exists, inherits correctly, and is constructable
     *
     * @return void
     */
    public function testConstruct()
    {

        $this->assertInstanceOf(
            DateInterval::class,
            $this->Object,
            'Fails if object does not exist'
        );

        $this->assertInstanceOf(
            \DateInterval::class,
            $this->Object,
            'Fails if object does not inherit from parent object'
        );

    }

    /**
     * Verify `toString` function returns correct value
     *
     * @return void
     */
    public function testToString()
    {

        $Attempts = [
            'P1Y2M3DT6S',
            'P1Y2MT5M',
            'P1YT4H',
            'P3D',
            'P2M',
            'P1Y',
            'PT4H5M6S',
            'PT4H5M',
            'PT4H',
        ];

        foreach ($Attempts as $Attempt) {

            $this->Object = new DateInterval($Attempt);

            $this->assertEquals(
                $this->Object->toString(),
                $Attempt,
                'Fails if function doesn\'t exist, or returns wrong value'
            );


            $this->assertEquals(
                (string) $this->Object,
                $Attempt,
                'Fails if function doesn\'t exist, or returns wrong value'
            );

        }

    }

    /**
     * Verify `equals` function returns correct value
     *
     * @return void
     */
    public function testEquals()
    {

        $Object1a = new DateInterval('P1Y2M3DT4H5M6S');
        $Object1b = new DateInterval('P1Y2M3DT4H5M6S');

        $this->assertTrue(
            $Object1a->equals($Object1b),
            'Fails if function doesn\'t exist or,'
            . ' returns that same values are different'
        );

        $Attempts = [
            'P7Y2M3DT4H5M6S',
            'P1Y7M3DT4H5M6S',
            'P1Y2M7DT4H5M6S',
            'P1Y2M3DT7H5M6S',
            'P1Y2M3DT4H7M6S',
            'P1Y2M3DT4H5M7S',
        ];

        foreach ($Attempts as $Attempt) {
            $this->assertFalse(
                $Object1a->equals(new DateInterval($Attempt)),
                'Fails if fucntion returns that different values are the same'
            );
        }

    }

    /**
     * Verify `compare` function evaluates correctly
     *
     * @return void
     */
    public function testCompare()
    {

        $Attempts = [
            [ 'P1Y2M3DT4H5M6S' , 'P1Y2M3DT4H5M6S' ,  0 ],
            [ 'P1Y1M1DT1H1M1S' , 'P2Y2M2DT2H2M2S' , -1 ],
            [ 'P3Y1M1DT1H1M1S' , 'P2Y2M2DT2H2M2S' ,  1 ],
            [ 'P2Y3M1DT1H1M1S' , 'P2Y2M2DT2H2M2S' ,  1 ],
            [ 'P2Y2M3DT1H1M1S' , 'P2Y2M2DT2H2M2S' ,  1 ],
            [ 'P2Y2M2DT3H1M1S' , 'P2Y2M2DT2H2M2S' ,  1 ],
            [ 'P2Y2M2DT2H3M1S' , 'P2Y2M2DT2H2M2S' ,  1 ],
            [ 'P2Y2M2DT2H2M3S' , 'P2Y2M2DT2H2M2S' ,  1 ],
            [ 'P2Y2M2DT2H2M1S' , 'P2Y2M2DT2H2M2S' , -1 ],
        ];

        foreach($Attempts as $Attempt) {
            $Object0 = new DateInterval($Attempt[0]);
            $Object1 = new DateInterval($Attempt[1]);
            $this->assertEquals(
                $Attempt[2],
                DateInterval::compare($Object0, $Object1),
                'Fails if objects compair incorrectly'
            );
        }

    }

}
