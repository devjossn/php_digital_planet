<?php
  /**
   * Cache Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: cache.class.php, v1.00 2016-04-20 18:20:24 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Cache
  {
      const CACHE_LIMIT = 100;
      private static $_cacheFile = '';
      private static $_cacheLifetime = '';

      const prefix = 'master_';
	  const css_suffix = '.css';
	  const js_suffix = '.js';

      /**
       * Cache::cssCache()
       * 
       * @param mixed $path
	   * @param mixed $source
       * @return
       */
      public static function cssCache($source, $path)
      {

          $target = $path . '/cache/';
          $last_change = self::lastChange($source, $path, "css");
          $temp = $target . self::prefix . 'main' . self::css_suffix;

          if (!file_exists($temp) || $last_change > filemtime($temp)) {
              if (!self::writeCssCache($source, $temp, $path)) {
                  Message::msgError("Minify:: - Writing the file to <{$target}> failed!");
				  Debug::AddMessage("errors", '<i>Exception</i>', 'Minify:: - Writing the file to <{$target}> failed!', "session");
              }
          }
		  
          return basename($temp);
      }

      /**
       * Cache::pluginCssCache()
       * 
       * @param mixed $path
       * @return
       */
      public static function pluginCssCache($path)
      {
          $source = File::findFiles(THEMEBASE . '/plugins/css/', array('fileTypes'=>array('css'),'level'=>0));
          $target = $path . '/cache/';
          $last_change = self::lastChange($source, $path, "css");
          $temp = $target . self::prefix . 'plugins_main' . self::css_suffix;

          if (!file_exists($temp) || $last_change > filemtime($temp)) {
              if (!self::writeCssCache($source, $temp, $path)) {
                  Message::msgError("Minify:: - Writing the file to <{$target}> failed!");
				  Debug::AddMessage("errors", '<i>Exception</i>', 'Minify:: - Writing the file to <{$target}> failed!', "session");
              }
          }
		  
          return basename($temp);
      }

      /**
       * Cache::moduleCssCache()
       * 
       * @param mixed $path
       * @return
       */
      public static function moduleCssCache($path)
      {
          $source = File::findFiles(THEMEBASE . '/modules/css/', array('fileTypes'=>array('css'),'level'=>0));
          $target = $path . '/cache/';
          $last_change = self::lastChange($source, $path, "css");
          $temp = $target . self::prefix . 'modules_main' . self::css_suffix;

          if (!file_exists($temp) || $last_change > filemtime($temp)) {
              if (!self::writeCssCache($source, $temp, $path)) {
                  Message::msgError("Minify:: - Writing the file to <{$target}> failed!");
				  Debug::AddMessage("errors", '<i>Exception</i>', 'Minify:: - Writing the file to <{$target}> failed!', "session");
              }
          }
		  
          return basename($temp);
      }

      /**
       * Cache::pluginJsCache()
       * 
       * @param mixed $path
       * @return
       */
      public static function pluginJsCache($path)
      {
          $source = File::findFiles(THEMEBASE . '/plugins/js/', array('fileTypes'=>array('js'),'level'=>0));
          $target = $path . '/cache/';
          $last_change = self::lastChange($source, $path, "js");
          $temp = $target . self::prefix . 'plugins_main' . self::js_suffix;

          if (!file_exists($temp) || $last_change > filemtime($temp)) {
              if (!self::writeJsCache($source, $temp, $path)) {
                  Message::msgError("Minify:: - Writing the file to <{$target}> failed!");
				  Debug::AddMessage("errors", '<i>Exception</i>', 'Minify:: - Writing the file to <{$target}> failed!', "session");
              }
          }
		  
          return basename($temp);
      }

      /**
       * Cache::moduleJsCache()
       * 
       * @param mixed $path
       * @return
       */
      public static function moduleJsCache($path)
      {
          $source = File::findFiles(THEMEBASE . '/modules/js/', array('fileTypes'=>array('js'),'level'=>0));
          $target = $path . '/cache/';
          $last_change = self::lastChange($source, $path, "js");
          $temp = $target . self::prefix . 'modules_main' . self::js_suffix;

          if (!file_exists($temp) || $last_change > filemtime($temp)) {
              if (!self::writeJsCache($source, $temp, $path)) {
                  Message::msgError("Minify:: - Writing the file to <{$target}> failed!");
				  Debug::AddMessage("errors", '<i>Exception</i>', 'Minify:: - Writing the file to <{$target}> failed!', "session");
              }
          }
		  
          return basename($temp);
      }
	  
      /**
       * Cache::lastChange()
       * 
       * @param mixed $files
       * @return
       */
      protected static function lastChange($files, $path, $type)
      {
          foreach ($files as $key => $file) {
              $files[$key] = filemtime($path . "/$type/" . $file);
          }

          sort($files);
          $files = array_reverse($files);

          return $files[key($files)];
      }

      /**
       * Cache::writeCssCache()
       * 
       * @param mixed $files
       * @param mixed $target
	   * @param mixed $path
       * @return
       */
      protected static function writeCssCache($files, $target, $path)
      {

          $content = "";

          foreach ($files as $file) {
              $content .= file_get_contents($path . '/css/' . $file);
          }


          $content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);
          $content = str_replace(array(
              "\r\n",
              "\r",
              "\n",
              "\t",
              '  ',
              '    ',
              '    '), '', $content);
          $content = str_replace(array(
              ': ',
              ' {',
              ';}'), array(
              ':',
              '{',
              '}'), $content);
			  
          if (!file_exists($path . '/cache/'))
              mkdir($path . '/cache/');
			  
          return file_put_contents($target, $content);
      }

      /**
       * Cache::writeJsCache()
       * 
       * @param mixed $files
       * @param mixed $target
	   * @param mixed $path
       * @return
       */
      protected static function writeJsCache($files, $target, $path)
      {

          $content = "";

          foreach ($files as $file) {
              $content .= file_get_contents($path . '/js/' . $file);
          }
		  
		  $content = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/', '', $content);
          $content = str_replace(array(
              "\r\n",
              "\r",
              "\n",
              "\t",
              '  ',
              '    ',
              '    '), '', $content);
			  
          if (!file_exists($path . '/cache/'))
              mkdir($path . '/cache/');
			  
          return file_put_contents($target, $content);
      }
	  
      /**
       * Cache::setCacheFile()
       * 
	   * Sets cache file name
       * @param string $cacheFile
       * @return
       */
      public static function setCacheFile($cacheFile = '')
      {
          self::$_cacheFile = !empty($cacheFile) ? $cacheFile : '';
      }

      /**
       * Cache::getCacheFile()
       * 
	   * Gets cache file name
       * @return
       */
      public static function getCacheFile()
      {
          return self::$_cacheFile;
      }

      /**
       * Cache::setCacheLifetime()
       * 
       * @param integer $cacheLifetime
       * @return
       */
      public static function setCacheLifetime($cacheLifetime = 0)
      {
          self::$_cacheLifetime = !empty($cacheLifetime) ? $cacheLifetime : 0;
      }

      /**
       * Cache::getCacheLifetime()
       * 
       * @return
       */
      public static function getCacheLifetime()
      {
          return self::$_cacheLifetime;
      }

      /**
       * Cache::setContent()
       * 
       * @param string $content
       * @param string $cacheDir
       * @return
       */
      public static function setContent($content = '', $cacheDir = '')
      {
          if (!empty(self::$_cacheFile)) {
              // remove oldest file if the limit of cache is reached
              if (File::getDirectoryFilesNumber($cacheDir) >= self::CACHE_LIMIT) {
                  File::removeDirectoryOldestFile($cacheDir);
              }

              // save the content to the cache file
              File::writeToFile(self::$_cacheFile, serialize($content));
          }
      }

      /**
       * Cache::getContent()
       * 
	   * Checks if cache exists and valid and retirn it's content
       * @param string $cacheFile
       * @param string $cacheLifetime
       * @return
       */
      public static function getContent($cacheFile = '', $cacheLifetime = '')
      {
          $result = '';
          $cacheContent = '';

          if (!empty($cacheFile))
              self::setCacheFile($cacheFile);
          if (!empty($cacheLifetime))
              self::setCacheLifetime($cacheLifetime);

          if (!empty(self::$_cacheFile) && !empty(self::$_cacheLifetime)) {
              if (file_exists(self::$_cacheFile)) {
                  $cacheTime = self::$_cacheLifetime * 60;
                  if ((filesize(self::$_cacheFile) > 0) && ((time() - $cacheTime) < filemtime(self::$_cacheFile))) {
                      ob_start();
                      include self::$_cacheFile;
                      $cacheContent = ob_get_contents();
                      ob_end_clean();
                  }
                  $result = !empty($cacheContent) ? unserialize($cacheContent) : $cacheContent;
              }
          }

          return $result;
      }

  }