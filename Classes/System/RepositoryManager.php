<?php

namespace Classes\System;

use Interfaces\System\{
      ILoader,
      ISaver
};

final class RepositoryManager implements ILoader, ISaver
{
      public static function Load(string $fileName) : ?string
      {
            try
            {
                  return file_get_contents($fileName);
            }
            catch (\Exception $ex)
            {
                  error_log($ex->getMessage());
                  return null;
            }
      }

      public static function Save(string $fileName, string $contents) : bool
      {
            try
            {
                  file_put_contents($fileName, utf8_encode($contents));
                  return true;
            }
            catch (\Exception $ex)
            {
                  error_log($ex->getMessage());
                  return false;
            }
      }
}