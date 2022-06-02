<?php

declare(strict_types=1);

namespace In2code\In2studyfinder\Domain\Model;

interface FacultyInterface
{
    public function getTitle(): string;

    public function setTitle(string $title);

    public function getOptionField(): string;
}
