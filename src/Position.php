<?php

declare(strict_types=1);

namespace BeastBytes\Geolocation;

final readonly class Position
{
    public function __construct(
        private Coordinates $coordinates,
        private int $timestamp
    )
    {
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}
