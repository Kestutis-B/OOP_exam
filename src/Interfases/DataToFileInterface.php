<?php

namespace Kestutisbilotas\Interfaces;

interface DataToFileInterface
{
    public function toFile(array $validatedData): void;
}