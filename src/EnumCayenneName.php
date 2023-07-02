<?php

namespace JalalLinuX\CayenneLpp;

use Spatie\Enum\Enum;

/**
 * @method static self ACCELEROMETER()
 * @method static self ANALOG_INPUT()
 * @method static self ANALOG_OUTPUT()
 * @method static self PRESSURE()
 * @method static self DIGITAL_INPUT()
 * @method static self DIGITAL_OUTPUT()
 * @method static self GPS()
 * @method static self GYRO_METER()
 * @method static self LUMINOSITY()
 * @method static self PRESENCE()
 * @method static self HUMIDITY()
 * @method static self TEMPERATURE()
 */
class EnumCayenneName extends Enum
{
    protected static function values(): array
    {
        return [
            'ACCELEROMETER' => 'accelerometer',
            'ANALOG_INPUT' => 'analogInput',
            'ANALOG_OUTPUT' => 'analogOutput',
            'PRESSURE' => 'pressure',
            'DIGITAL_INPUT' => 'digitalInput',
            'DIGITAL_OUTPUT' => 'digitalOutput',
            'GPS' => 'gps',
            'GYRO_METER' => 'gyrometer',
            'LUMINOSITY' => 'luminosity',
            'PRESENCE' => 'presence',
            'HUMIDITY' => 'humidity',
            'TEMPERATURE' => 'temperature',
        ];
    }

    protected static function labels(): array
    {
        return [
            'ACCELEROMETER' => 'Accelerometer',
            'ANALOG_INPUT' => 'Analog Input',
            'ANALOG_OUTPUT' => 'Analog Output',
            'PRESSURE' => 'Pressure',
            'DIGITAL_INPUT' => 'Digital Input',
            'DIGITAL_OUTPUT' => 'Digital Output',
            'GPS' => 'GPS',
            'GYRO_METER' => 'Gyro Meter',
            'LUMINOSITY' => 'Luminosity',
            'PRESENCE' => 'Presence',
            'HUMIDITY' => 'Humidity',
            'TEMPERATURE' => 'Temperature',
        ];
    }
}
