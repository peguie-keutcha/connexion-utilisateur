<?php

namespace Interfaces\System;

interface ILoader
{
      public static function Load(string $fileName) : ?string;
}