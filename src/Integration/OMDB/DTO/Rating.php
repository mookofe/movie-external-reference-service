<?php
declare(strict_types = 1);

namespace App\Integration\OMDB\DTO;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Rating
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class Rating
{
    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Source")
     */
    private $source;

    /**
     * @var string
     *
     * @Type("string")
     * @Serializer\SerializedName("Value")
     */
    private $value;

    /**
     * Get source name
     *
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}