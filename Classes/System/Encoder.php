<?php

namespace Classes\System\Security;

use Enumerations\Security\EncryptMode;

final class Encoder
{
      public static function Encode(string $mode, string $value) : ?string
      {
            switch ($mode)
            {
                  case EncryptMode::Base64:
                        return base64_encode($value);
                  case EncryptMode::SHA256:
                        throw new \Exception("Not implemented !");
            }

            return null;
      }

      public static function Decode(string $mode, string $value) : ?string
      {
            switch ($mode)
            {
                  case EncryptMode::Base64:
                        return base64_decode($value);
                  case EncryptMode::SHA256:
                        throw new \Exception("Not implemented !");
            }

            return null;
      }

      public static function ParseUTF8_MalFormatted(array $origin) : array
      {
            $temp = [];
            $output = [];
            foreach ($origin as $user)
                  array_push($temp, json_encode($user));

            foreach ($temp as $user)
                  array_push($output, json_decode($user));

            unset($temp);
            return $output;
      }
}