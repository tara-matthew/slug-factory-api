<?php
namespace App\DataTransferObjects;

class PrintedDesignData
{
    public function __construct(
        public string $title,
        public string $description,
        public int $user_id,
        public ?array $images = [] // TODO could this be a value object?
    ){}
}
