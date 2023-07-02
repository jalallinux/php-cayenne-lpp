<?php

namespace JalalLinuX\CayenneLpp;

use Countable;
use Iterator;

const LPP_HEADER_SIZE = 2;

class Decoder implements Iterator, Countable
{
    use Endian,
        Types\DigitalInput,
        Types\DigitalOutput,
        Types\AnalogInput,
        Types\AnalogOutput,
        Types\Luminosity,
        Types\Presence,
        Types\Temperature,
        Types\RelativeHumidity,
        Types\Accelerometer,
        Types\BarometricPressure,
        Types\Gyrometer,
        Types\GPS;

    /**
     * @var Raw[]
     */
    public array $data;

    private int $index;

    private array $type2size;

    private array $type2name;

    public function __construct(string $payload)
    {
        $this->type2size = [
            Types\LPP_ACCELEROMETER => Types\LPP_ACCELEROMETER_SIZE,
            Types\LPP_ANALOG_INPUT => Types\LPP_ANALOG_INPUT_SIZE,
            Types\LPP_ANALOG_OUTPUT => Types\LPP_ANALOG_OUTPUT_SIZE,
            Types\LPP_BAROMETRIC_PRESSURE => Types\LPP_BAROMETRIC_PRESSURE_SIZE,
            Types\LPP_DIGITAL_INPUT => Types\LPP_DIGITAL_INPUT_SIZE,
            Types\LPP_DIGITAL_OUTPUT => Types\LPP_DIGITAL_OUTPUT_SIZE,
            Types\LPP_GPS => Types\LPP_GPS_SIZE,
            Types\LPP_GYROMETER => Types\LPP_GYROMETER_SIZE,
            Types\LPP_LUMINOSITY => Types\LPP_LUMINOSITY_SIZE,
            Types\LPP_PRESENCE => Types\LPP_PRESENCE_SIZE,
            Types\LPP_RELATIVE_HUMIDITY => Types\LPP_RELATIVE_HUMIDITY_SIZE,
            Types\LPP_TEMPERATURE => Types\LPP_TEMPERATURE_SIZE,
        ];

        $this->type2name = [
            Types\LPP_ACCELEROMETER => EnumCayenneName::ACCELEROMETER(),
            Types\LPP_ANALOG_INPUT => EnumCayenneName::ANALOG_INPUT(),
            Types\LPP_ANALOG_OUTPUT => EnumCayenneName::ANALOG_OUTPUT(),
            Types\LPP_BAROMETRIC_PRESSURE => EnumCayenneName::PRESSURE(),
            Types\LPP_DIGITAL_INPUT => EnumCayenneName::DIGITAL_INPUT(),
            Types\LPP_DIGITAL_OUTPUT => EnumCayenneName::DIGITAL_OUTPUT(),
            Types\LPP_GPS => EnumCayenneName::GPS(),
            Types\LPP_GYROMETER => EnumCayenneName::GYRO_METER(),
            Types\LPP_LUMINOSITY => EnumCayenneName::LUMINOSITY(),
            Types\LPP_PRESENCE => EnumCayenneName::PRESENCE(),
            Types\LPP_RELATIVE_HUMIDITY => EnumCayenneName::HUMIDITY(),
            Types\LPP_TEMPERATURE => EnumCayenneName::TEMPERATURE(),
        ];

        $this->data = $this->decode($payload);
        $this->index = 0;
    }

    /**
     * @param string $payload
     * @return Raw[]
     * @throws Exception
     */
    private function decode(string $payload): array
    {
        $out = [];
        $channel = 0;
        $type = 0;

        // Detect empty payload
        if ($payload === '') {
            return $out;
        }

        while (true) {
            if (strlen($payload) < LPP_HEADER_SIZE) {
                throw new Exception('Header is too short');
            }

            // Read frame (header + raw data)
            $channel = unpack('C', $payload[0])[1];
            $type = unpack('C', $payload[1])[1];
            $size = $this->getTypeSize($type) - LPP_HEADER_SIZE;
            $chunck = substr($payload, LPP_HEADER_SIZE, $size);
            if (strlen($chunck) !== $size) {
                throw new Exception('Incomplete data');
            }

            // Decode and store
            $out[] = new Raw($channel, $type, $this->type2name[$type], $this->decodeType($type, $chunck));

            // Reduce payload
            $payload = substr($payload, $size + LPP_HEADER_SIZE);
            if (strlen($payload) === 0) {
                break;
            }
        }

        return $out;
    }

    private function decodeType(int $type, string $data): array
    {
        switch ($type) {
            case Types\LPP_ACCELEROMETER:
                return $this->decodeAccelerometer($data);

            case Types\LPP_ANALOG_INPUT:
                return $this->decodeAnalogInput($data);

            case Types\LPP_ANALOG_OUTPUT:
                return $this->decodeAnalogOutput($data);

            case Types\LPP_BAROMETRIC_PRESSURE:
                return $this->decodeBarometricPressure($data);

            case Types\LPP_DIGITAL_INPUT:
                return $this->decodeDigitalInput($data);

            case Types\LPP_DIGITAL_OUTPUT:
                return $this->decodeDigitalOutput($data);

            case Types\LPP_GPS:
                return $this->decodeGPS($data);

            case Types\LPP_GYROMETER:
                return $this->decodeGyrometer($data);

            case Types\LPP_LUMINOSITY:
                return $this->decodeLuminosity($data);

            case Types\LPP_PRESENCE:
                return $this->decodePresence($data);

            case Types\LPP_RELATIVE_HUMIDITY:
                return $this->decodeRelativeHumidity($data);

            case Types\LPP_TEMPERATURE:
                return $this->decodeTemperature($data);

            default:
                return [];
        }
    }

    private function getTypeSize(int $type): int
    {
        if ($this->isTypeSupported($type) === false) {
            throw new Exception('Unknown type');
        }

        return $this->type2size[$type];
    }

    private function isTypeSupported(int $type): bool
    {
        return array_key_exists($type, $this->type2size);
    }

    public function current()
    {
        return $this->data[$this->index];
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        $this->index += 1;
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->index]);
    }

    public function count(): int
    {
        return count($this->data);
    }
}
