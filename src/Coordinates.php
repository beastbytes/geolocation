<?php

declare(strict_types=1);

namespace BeastBytes\Geolocation;

use InvalidArgumentException;

final readonly class Coordinates
{
    private const string INVAliD_ACCURACY_MESSAGE = '{a} must be greater than or equal to zero';
    private const string INVAliD_LAT_LNG_MESSAGE = '{l} must be from -{v} to {v}';
    private const int MAX_LATITUDE = 90;
    private const int MAX_LONGITUDE = 180;

    /**
     * @param float $latitude The position's latitude in decimal degrees
     * @param float $longitude The position's longitude in decimal degrees
     * @param float $accuracy The accuracy of the latitude and longitude properties in metres
     * @param float|null $altitude The position's altitude in metres above the WGS84 ellipsoid
     * @param float|null $altitudeAccuracy The accuracy of the altitude expressed in metres
     * @param float|null $heading The direction towards which the device is facing in degrees relative to true north
     * @param float|null $speed The velocity of the device in metres per second
     */
    public function __construct(
        private float $latitude,
        private float $longitude,
        private float $accuracy,
        private ?float $altitude = null,
        private ?float $altitudeAccuracy = null,
        private ?float $heading = null,
        private ?float $speed = null
    )
    {
        if (abs($this->latitude) > self::MAX_LATITUDE) {
            throw new InvalidArgumentException(strtr(
                self::INVAliD_LAT_LNG_MESSAGE,
                [
                    '{l}' => '`latitude`',
                    '{v}' => self::MAX_LATITUDE
                ]
            ));
        }
        if (abs($this->longitude) > self::MAX_LONGITUDE) {
            throw new InvalidArgumentException(strtr(
                self::INVAliD_LAT_LNG_MESSAGE,
                [
                    '{l}' => '`longitude`',
                    '{v}' => self::MAX_LONGITUDE
                ]
            ));
        }
        if ($this->accuracy < 0) {
            throw new InvalidArgumentException(strtr(self::INVAliD_ACCURACY_MESSAGE, ['{a}' => '`accuracy`']));
        }
        if (is_numeric($this->altitudeAccuracy) && $this->altitudeAccuracy < 0) {
            throw new InvalidArgumentException(strtr(self::INVAliD_ACCURACY_MESSAGE, ['{a}' => '`altitudeAccuracy`']));
        }
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getAccuracy(): float
    {
        return $this->accuracy;
    }

    public function getAltitude(): ?float
    {
        return $this->altitude;
    }

    public function getAltitudeAccuracy(): ?float
    {
        return $this->altitudeAccuracy;
    }

    public function getHeading(): ?float
    {
        return $this->heading;
    }

    public function getSpeed(): ?float
    {
        return $this->speed;
    }
}
