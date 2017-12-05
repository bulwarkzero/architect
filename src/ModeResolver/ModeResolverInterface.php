<?php

namespace Bulwark\Architect\ModeResolver;

interface ModeResolverInterface
{
    public function resolve($property, &$object, &$root, $fullPropertyPath);
}
