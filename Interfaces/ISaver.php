<?php

namespace Interfaces\System;

interface ISaver
{
      public static function Save(string $fileName, string $contents) : bool;
}