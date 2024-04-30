<?php

namespace Classes\System;

use Classes\System\Security\Encoder;
use Enumerations\Alphabets;
use Enumerations\Columns;
use Interfaces\System\IDbLoader;

final class DbLoader implements IDbLoader
{
      private const dbFile = __DIR__ 
            . '\..\..\DB\2-random-persons-20240427155132.json';
      
      private const exportFile = __DIR__ . '\..\..\clear_mdp.txt';

      // PRIVATES
      private static function randomPassword() {
            $pass = array();
            $alphaLength = strlen(Alphabets::PasswordChars) - 1;

            for ($i = 0; $i < 8; $i++)
                  $pass[] = Alphabets::PasswordChars[
                        rand(0, $alphaLength)];

            return implode($pass);
      }

      private static function containsPwdColumn(array $ar) : bool
      {
            return in_array(Columns::Password, $ar);
      }

      private static function bindPassword(array $ar) : array
      {
            $output = [];

            foreach ($ar as $row)
            {
                  $pwd = DbLoader::randomPassword();
                  $row[Columns::Password] = $pwd;

                  array_push($output, $row);
            }

            return $output;
      }

      private static function asyncExport(array $ar)
      {
            try
            {
                  $file = fopen(DbLoader::exportFile, "w") or die("Unable to open file!");

                  foreach ($ar as $row)
                        fwrite($file, $row . PHP_EOL);
                  
                  fclose($file);
                  return true;
            }
            catch (\Exception $ex)
            {
                  error_log($ex);
                  return false;
            }
      }

      private static function getExportUserValues(array $ar) : string
      {
            return utf8_encode($ar[Columns::eMail] . ";" . $ar[Columns::Password] . PHP_EOL);
      }

      private static function extractExportArray(array $ar) : array
      {
            $export = [];

            foreach ($ar as $row)
                  array_push($export, DbLoader::getExportUserValues($row));

            return $export;
      }

      private static function exportPwd(array $ar, bool $asyncWriting = false) : bool
      {
            $exportArray = DbLoader::extractExportArray($ar);

            return $asyncWriting
                  ? DbLoader::asyncExport($exportArray)
                  : RepositoryManager::Save(
                        DbLoader::exportFile,
                        implode(PHP_EOL,
                              $exportArray));
      }

      // PUBLICS
      public static function GetDatas(bool $exportPwd = false) : array
      {
            $ar_Users = json_decode(
                  RepositoryManager::Load(
                                    DbLoader::dbFile), true);

            if (!DbLoader::containsPwdColumn($ar_Users))
            {
                  $ar_Users = DbLoader::bindPassword($ar_Users);
                  
                  RepositoryManager::Save(
                        DbLoader::dbFile,
                        json_encode(Encoder::ParseUTF8_MalFormatted($ar_Users))
                  );
            }

            if ($exportPwd)
                  DbLoader::exportPwd($ar_Users);

            return $ar_Users;
      }
}