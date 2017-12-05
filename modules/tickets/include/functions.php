<?php
/**
 * Please Email Ticketer of Batch Group & User Emails
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   	The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     	General Public License version 3 (http://labs.coop/briefs/legal/general-public-licence/13,3.html)
 * @author      	Simon Roberts (wishcraft) <wishcraft@users.sourceforge.net>
 * @subpackage  	tickets
 * @description 	Email Ticking for Support/Faults/Management of Batch Group & User managed emails tickets
 * @version			1.0.5
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.5/Modules/tickets
 * @link        	https://sourceforge.net/projects/chronolabs/files/XOOPS%202.6/Modules/tickets
 * @link			https://sourceforge.net/p/xoops/svn/HEAD/tree/XoopsModules/tickets
 * @link			http://internetfounder.wordpress.com
 */


if (!function_exists("getURIData")) {

	/* function getURIData()
	 *
	* 	Get a supporting domain system for the API
	* @author 		Simon Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		float()
	*/
	function getURIData($uri = '', $posts = array(), $headers = array(), $timeout = 45, $connectout = 45)
	{
		if (!function_exists("curl_init"))
		{
			return file_get_contents($uri);
		}
		if (!$btt = curl_init($uri)) {
			return false;
		}
		if (count($headers)) {
			curl_setopt($btt, CURLOPT_HEADER, true);
			curl_setopt($btt, CURLOPT_HEADERS, $headers);
		} else
			curl_setopt($btt, CURLOPT_HEADER, 0);
		if (count($posts)) {
			curl_setopt($btt, CURLOPT_POST, true);
			curl_setopt($btt, CURLOPT_POSTFIELDS, http_build_query($posts));
		} else
			curl_setopt($btt, CURLOPT_POST, 0);
		curl_setopt($btt, CURLOPT_CONNECTTIMEOUT, $connectout);
		curl_setopt($btt, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($btt, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($btt, CURLOPT_VERBOSE, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($btt);
		curl_close($btt);
		return $data;
	}
}


if (!function_exists("readRawFile")) {
	/**
	 * Return the contents of this File as a string.
	 *
	 * @param string $file
	 * @param string $bytes where to start
	 * @param string $mode
	 * @param boolean $force If true then the file will be re-opened even if its already opened, otherwise it won't
	 * @return mixed string on success, false on failure
	 * @access public
	 */
	function readRawFile($file = '', $bytes = false, $mode = 'rb', $force = false)
	{
		$success = false;
		if ($bytes === false) {
			$success = file_get_contents($file);
		} elseif ($fhandle = fopen($file, $mode)) {
			if (is_int($bytes)) {
				$success = fread($fhandle, $bytes);
			} else {
				$data = '';
				while (! feof($fhandle)) {
					$data .= fgets($fhandle, 4096);
				}
				$success = trim($data);
			}
			fclose($fhandle);
		}
		return $success;
	}
}

if (!function_exists("writeRawFile")) {
	/**
	 *
	 * @param string $file
	 * @param string $data
	 */
	function writeRawFile($file = '', $data = '')
	{
		if (!is_dir(dirname($file)))
			mkdir(dirname($file), 0777, true);
		if (is_file($file))
			unlink($file);
		$ff = fopen($file, 'w');
		fwrite($ff, $data, strlen($data));
		return fclose($ff);
	}
}

if (!function_exists("ticketsGetTollerence")) {
	/**
	 * 
	 * @param string $confname
	 * @param integer $value
	 * @param integer $min
	 * @param integer $max
	 * @param integer $seed
	 * @return unknown|number|multitype:number |boolean
	 */
	function ticketsGetTollerence($confname = '', $value = 0, $min = 10, $max = 90, $seed = 0)
	{
		static $step = 4;
		global $ticketsModule, $ticketsConfigs, $ticketsConfigsList, $ticketsConfigsOptions;
		
		if ($seed == 0)
			$seed = microtime(true);
		// Randomise from seed		
		mt_rand(-($seed + (mt_rand(0, $seed/4)/100000)), ($seed + (mt_rand(0, $seed/4)/100000)));
		mt_rand(-($seed + (mt_rand(0, $seed/3)/100000)), ($seed + (mt_rand(0, $seed/3)/100000)));
		mt_rand(-($seed + (mt_rand(0, $seed/2)/100000)), ($seed + (mt_rand(0, $seed/2)/100000)));
		mt_rand(-($seed + (mt_rand(0, $seed/5)/100000)), ($seed + (mt_rand(0, $seed/5)/100000)));

		// get tollerence integer or random envaluement arrays!
		if ($value = 0)
		{
			if (isset($ticketsConfigsList[$confname]))
				return $ticketsConfigsList[$confname];
			else
			{
				if (mt_rand(-2,1)>0)
					$step = mt_rand(3,8);
				$value = 0;
				for($i = $min; $i <= mt_rand($min, $max); $i=$i+$step)
					$value = $value + $step;
				return $value;
			}
		} else {
			$ret = array();
			if (!isset($ticketsConfigsOptions[$confname]))
			{
				$options = array();
				foreach($ticketsConfigs as $key => $config)
					if ($config->getVar('conf_name') = $confname)
					{
						$options = $config->getConfigOptions(new Criteria('conf_id', $config->getVar('conf_id')));
						continue;
					}
				if (!empty($options))
				{
					$ticketsConfigsOptions[$confname] = $options;
					foreach($options as $id => $option)
						$ret[$option->getVar('confop_name')] = $option->getVar('confop_value');
				}
			} else {
				foreach($ticketsConfigsOptions[$confname] as $id => $option)
					$ret[$option->getVar('confop_name')] = $option->getVar('confop_value');
			}
			if (empty($ret))
			{
				$ret = array();
				for($i = $min; $i <= $max; $i=$i+$step)
					$ret["$i%"] = $i;
			}
			return $ret;
		}
		return false;
	}
}


if (!function_exists("getEnumeratorValues")) {
	/**
	 * Loads a field enumerator values
	 * 
	 * @param string $filename
	 * @param string $variable
	 * @return array():
	 */
	function getEnumeratorValues($filename = '', $variable = '')
	{
		$variable = str_replace(array('-', ' '), "_", $variable);
		static $ret = array();
		if (!isset($ret[basename($file)]))
			if (file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . 'enumerators' . DIRECTORY_SEPARATOR . "$variable__" . str_replace("php", "diz", basename($filename))))
				foreach( file($file) as $id => $value )
					if (!empty($value))
						$ret[basename($file)][$value] = $value;
		return $ret[basename($file)];
	}
}

if (!function_exists("ticketsDecryptPassword")) {
	/**
	 * Decrypts a password
	 *
	 * @param string $password
	 * @param string $cryptiopass
	 * @return string:
	 */
	function ticketsDecryptPassword($password = '', $cryptiopass = '')
	{
		$sql = "SELECT AES_DECRYPT(%s, %s) as `crypteec`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($password), $GLOBALS["xoopsDB"]->quote($cryptiopass))));
		return $result;
	}
}


if (!function_exists("ticketsEncryptPassword")) {
	/**
	 * Encrypts a password
	 *
	 * @param string $password
	 * @param string $cryptiopass
	 * @return string:
	 */
	function ticketsEncryptPassword($password = '', $cryptiopass = '')
	{
		$sql = "SELECT AES_ENCRYPT(%s, %s) as `encrypic`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($password), $GLOBALS["xoopsDB"]->quote($cryptiopass))));
		return $result;
	}
}


if (!function_exists("ticketsCompressData")) {
	/**
	 * Compresses a textualisation
	 *
	 * @param string $data
	 * @return string:
	 */
	function ticketsCompressData($data = '')
	{
		$sql = "SELECT COMPRESS(%s) as `compressed`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($data))));
		return $result;
	}
}


if (!function_exists("ticketsDecompressData")) {
	/**
	 * Compresses a textualisation
	 *
	 * @param string $data
	 * @return string:
	 */
	function ticketsDecompressData($data = '')
	{
		$sql = "SELECT DECOMPRESS(%s) as `compressed`";
		list($result) = $GLOBALS["xoopsDB"]->fetchRow($GLOBALS["xoopsDB"]->queryF(sprintf($sql, $GLOBALS["xoopsDB"]->quote($data))));
		return $result;
	}
}

