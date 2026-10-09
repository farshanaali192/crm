<?php

namespace App\Contracts;

interface ContactSource
{
    public function getType(): string;

    public function getId(): int;
}
