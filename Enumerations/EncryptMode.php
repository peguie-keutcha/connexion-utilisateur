<?php

namespace Enumerations\Security;

abstract class EncryptMode
{
      public const Base64 = "base64";
      public const SHA256 = "sha256";
      public const Default = EncryptMode::SHA256;
}