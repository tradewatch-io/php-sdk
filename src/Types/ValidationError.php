<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;
use Tradewatch\Core\Types\Union;

class ValidationError extends JsonSerializableType
{
    /**
     * @var array<(
     *    string
     *   |int
     * )> $loc
     */
    #[JsonProperty('loc'), ArrayType([new Union('string', 'integer')])]
    public array $loc;

    /**
     * @var string $msg
     */
    #[JsonProperty('msg')]
    public string $msg;

    /**
     * @var string $type
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   loc: array<(
     *    string
     *   |int
     * )>,
     *   msg: string,
     *   type: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->loc = $values['loc'];
        $this->msg = $values['msg'];
        $this->type = $values['type'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
