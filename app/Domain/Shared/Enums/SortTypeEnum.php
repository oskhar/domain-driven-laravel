<?php

namespace Domain\Shared\Enums;

enum SortTypeEnum: string
{
    /**
     * Sort type in bahasa
     */
    case TERBARU = "terbaru";
    case TERLAMA = "terlama";
    case AZ = "a-z";
    case ZA = "z-a";
    case TERMURAH = "termurah";
    case TERMAHAL = "termahal";

    public function column(): string
    {
        return match ($this) {
            self::AZ => "full_name",
            self::ZA => "full_name",
            self::TERBARU => "updated_at",
            self::TERLAMA => "updated_at",
            self::TERMURAH => "price",
            self::TERMAHAL => "price",
        };
    }

    public function direction(): string
    {
        return match ($this) {
            self::AZ => "ASC",
            self::ZA => "DESC",
            self::TERBARU => "DESC",
            self::TERLAMA => "ASC",
            self::TERMURAH => "ASC",
            self::TERMAHAL => "DESC",
        };
    }
}
