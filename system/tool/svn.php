<?php
/**
 * This class for execute the external program of svn
 * 使用PHP完成SVN的操作，包括复制，查看列表，删除，移动，创建目录，查看diff,更新，合并，提交，
 * 获取状态，获取commit log,获取当前版本号操作。在svn 1.6.11版本中测试通过。
 *
 * @auth Seven Yang <qineer@gmail.com>
 */
define('SVN_USERNAME', 'zy73122');
define('SVN_PASSWORD', '1');
define('SVN_CONFIG_DIR', '/home/www/');
class svn
{

	/**
	 * List directory entries in the repository
	 *
	 * @param string a specific project repository path
	 * @return bool array, if validated successfully, otherwise false
	 */
	public static function ls($repository)
	{
		$command = "/usr/bin/svn ls " . $repository;
		$output = self::runCmd($command);
		$outputstr = implode("<br>", $output);
		if (strpos($outputstr, 'non-existent in that revision'))
		{
			return false;
		}

		return $output;
	}

	/**
	 * Duplicate something in working copy or repository, remembering history
	 *
	 * @param $src
	 * @param $dst
	 * @param $comment string specify log message
	 * @return bool true, if copy successfully, otherwise return the error message
	 *
	 * @todo comment need addslashes for svn commit
	 */
	public static function copy($src, $dst, $comment)
	{
		$command = "/usr/bin/svn cp $src $dst -m '$comment'";
		$output = self::runCmd($command);
		$output = implode("<br>", $output);

		if (strpos($output, 'Committed revision'))
		{
			return true;
		}

		return "<br>" . $command . "<br>" . $output;
	}

	/**
	 * Remove files and directories from version control
	 *
	 * @param $url
	 * @return bool true, if delete successfully, otherwise return the error message
	 *
	 * @todo comment need addslashes for svn commit
	 */
	public static function delete($url, $comment)
	{
		$command = "/usr/bin/svn del $url -m '$comment'";
		$output = self::runCmd($command);
		$output = implode('<br>', $output);
		if (strpos($output, 'Committed revision'))
		{
			return true;
		}

		return "<br>" . $command . "<br>" . $output;
	}

	/**
	 * Move and/or rename something in working copy or repository
	 *
	 * @param $src string trunk path
	 * @param $dst string new branch path
	 * @param $comment string specify log message
	 * @return bool true, if move successfully, otherwise return the error message
	 *
	 * @todo comment need addslashes for svn commit
	 */
	public static function move($src, $dst, $comment)
	{
		$command = "/usr/bin/svn mv $src $dst -m '$comment'";
		$output = self::runCmd($command);
		$output = implode('<br>', $output);

		if (strpos($output, 'Committed revision'))
		{
			return true;
		}

		return "<br>" . $command . "<br>" . $output;
	}

	/**
	 * Create a new directory under version control
	 *
	 * @param $url string
	 * @param $comment string the svn message
	 * @return bool true, if create successfully, otherwise return the error message
	 *
	 * @todo comment need addslashes for svn commit
	 */
	public static function mkdir($url, $comment)
	{
		$command = "/usr/bin/svn mkdir $url -m '$comment'";
		$output = self::runCmd($command);
		$output = implode('<br>', $output);

		if (strpos($output, 'Committed revision'))
		{
			return true;
		}

		return "<br>" . $command . "<br>" . $output;
	}

	public static function diff($pathA, $pathB)
	{
		$output = self::runCmd("/usr/bin/svn diff $pathA $pathB");
		return implode('<br>', $output);
	}

	/**
	 * 获取两个版本之间的差异文件
	 * @param string $dir （local path or repository） 可以是本地svn目录：/data/wwwroot/testsvn..，或服务器地址：SVN://..
	 * @param int $revision1
	 * @param int $revision2
	 * @return array
	 */
	public static function diff_revision($dir, $revision1, $revision2)
	{
		$command = "/usr/bin/svn diff -r $revision2:$revision1 $dir --summarize --xml";
		$output = self::runCmd($command);
		$string = implode('', $output);

		/*
		 * <?xml version="1.0"?>
<diff>
<paths>
	<path   props="none"   kind="file"   item="deleted">/root/test/Documentation/TODO</path>
	<path   props="none"   kind="file"   item="modified">/root/test/1.txt</path>
</paths>
</diff>
		 */
		if (strpos($string, 'No such revision') !== false)
			return array();

		//if (strpos($string, 'does not exist in the repository') !== false)
		//	return array();
		$xml = new SimpleXMLElement($string);
		$arr = self::xmlToArr($xml, false);
		$result = array();
		$key = 0;
		if (empty($arr)) return array();
		$datas = $arr['paths']['path'];
		if (!isset($datas[0]))
		{
			$tmp = array($datas);
			$datas = $tmp;
		}
		//print_r($datas);exit;
		foreach ($datas as $one)
		{
			$result[$key]['kind'] = $one['attributes']['kind'];
			$result[$key]['act'] = $one['attributes']['item'];
			$result[$key]['file'] = $one['value'];
			$key++;
		}
		return $result;
	}

	public static function checkout($url, $dir)
	{
		$command = "cd $dir && /usr/bin/svn co $url";
		$output = self::runCmd($command);
		$output = implode('<br>', $output);
		if (strstr($output, 'Checked out revision'))
		{
			return true;
		}

		return "<br>" . $command . "<br>" . $output;
	}

	public static function update($path)
	{
		$command = "cd $path && /usr/bin/svn up";
		$output = self::runCmd($command);
		$output = implode('<br>', $output);

		preg_match_all("/[0-9]+/", $output, $ret);
		if (! $ret[0][0])
		{
			return "<br>" . $command . "<br>" . $output;
		}

		return $ret[0][0];
	}

	public static function merge($revision, $url, $dir)
	{
		$command = "cd $dir && /usr/bin/svn merge -r1:$revision $url";
		$output = implode('<br>', self::runCmd($command));
		if (strstr($output, 'Text conflicts'))
		{
			return 'Command: ' . $command . '<br>' . $output;
		}

		return true;
	}

	public static function commit($dir, $comment)
	{
		$command = "cd $dir && /usr/bin/svn commit -m'$comment'";
		$output = implode('<br>', self::runCmd($command));

		if (strpos($output, 'Committed revision') || empty($output))
		{
			return true;
		}

		return $output;
	}

	public static function status($dir)
	{
		$command = "/usr/bin/svn st -u $dir --xml"; //-uv
		$output = self::runCmd($command);
		$string = implode('', $output);

		$xml = new SimpleXMLElement($string);
		$result = array();
		$key = 0;
		foreach ($xml->target->entry as $entry)
		{
			$entry = (array)$entry;
			$entry["wc-status"] = (array)$entry["wc-status"];
			$entry["wc-status"]['commit'] = (array)$entry["wc-status"]['commit'];
			$entry["repos-status"] = (array)$entry["repos-status"];
			$result[$key]['path'] = $entry["@attributes"]["path"];
			$result[$key]['revision'] = strval($entry["wc-status"]['commit']["@attributes"]["revision"]);
			$result[$key]['author'] = strval($entry["wc-status"]['commit']["author"]);
			$result[$key]['date'] = strval($entry["wc-status"]['commit']["date"]);
			$result[$key]['act'] = strval($entry["repos-status"]["@attributes"]["item"]);
			$key++;
		}
		return $result;
	}

	public static function hasConflict($dir)
	{
		$output = self::getStatus($dir);
		foreach ($output as $line)
		{
			if ('C' == substr(trim($line), 0, 1) || ('!' == substr(trim($line), 0, 1)))
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * Show the log messages for a set of path with XML
	 *
	 * @param path string
	 * @return log message string
	 */
	public static function log($path)
	{
		$command = "/usr/bin/svn log $path --xml";
		$output = self::runCmd($command);
		$string = implode('', $output);
		/*
		 * $string like this:
<?xml version="1.0"?>
<log>
<logentry
   revision="8">
<author>zy73122</author>
<date>2013-05-28T00:04:42.184657Z</date>
<msg></msg>
</logentry>
<logentry
   revision="7">
<author>zy73122</author>
<date>2013-05-27T23:34:59.320416Z</date>
<msg></msg>
</logentry>
</log>
		 */
		$xml = new SimpleXMLElement($string);
		$arr = self::xmlToArr($xml, false);
		if (empty($arr)) return array();
		$result = array();
		foreach ($arr['logentry'] as $one)
		{
			$result[] = array(
				'revision' => $one['attributes']['revision'],
				'author' => $one['value']['author'],
				'date' => $one['value']['date'],
				'msg' => $one['value']['msg'],
			);
		}
		return $result;
	}

	/**
	 * 获取当前版本号
	 * @param string $path （local path or repository） 可以是本地svn目录：/data/wwwroot/testsvn..，或服务器地址：SVN://..
	 * @return int
	 */
	public static function getPathRevision($path)
	{
		$command = "/usr/bin/svn info $path --xml";
		$output = self::runCmd($command);
		$string = implode('', $output);
		$xml = new SimpleXMLElement($string);
		$arr = self::xmlToArr($xml, false);
		foreach ($arr['entry']['attributes'] as $key => $value)
		{
			if ('revision' == $key)
			{
				return $value;
			}
		}
		return false;
	}

	public static function getHeadRevision($path)
	{
		$command = "cd $path && /usr/bin/svn up";
		$output = self::runCmd($command);
		$output = implode('<br>', $output);

		preg_match_all("/[0-9]+/", $output, $ret);
		if (! $ret[0][0])
		{
			return "<br>" . $command . "<br>" . $output;
		}

		return $ret[0][0];
	}

	/**
	 * Run a cmd and return result
	 *
	 * @param string command line
	 * @param boolen true need add the svn authentication
	 * @return array the contents of the output that svn execute
	 */
	protected static function runCmd($command)
	{
		// --config-dir DIR
		// Instructs Subversion to read configuration information from the specified directory instead of the default location (.subversion in the user's home directory).
		//$authCommand = ' --username ' . SVN_USERNAME . ' --password ' . SVN_PASSWORD . ' --no-auth-cache --non-interactive --config-dir ' . SVN_CONFIG_DIR . '.subversion';
		$authCommand = ' --username ' . SVN_USERNAME . ' --password ' . SVN_PASSWORD . ' --no-auth-cache --non-interactive';
		//print_r($command . $authCommand . " 2>&1");exit;
		exec($command . $authCommand . " 2>&1", $output);

		return $output;
	}
// 	protected static function runCmd($command)
// 	{
// 		$authCommand = ' --username ' . SVN_USERNAME . ' --password ' . SVN_PASSWORD . ' --no-auth-cache --non-interactive --config-dir ' . SVN_CONFIG_DIR . '.subversion';
// 		//print_r($command . $authCommand . " 2>&1");exit;
// 		exec("/data/wwwroot/boss/myshell /bin/sh /data/wwwroot/boss/svn.sh", $output);
// 		return $output;
// 	}

	protected static function xmlToArr($xml, $root = true) {

		if (!$xml->children()) {
			return (string) $xml;
		}
		$array = array();
		foreach ($xml->children() as $element => $node) {
			$totalElement = count($xml->{$element});
			if (!isset($array[$element])) {
				$array[$element] = "";
			}
			// Has attributes
			if ($attributes = $node->attributes()) {
				$data = array(
					'attributes' => array(),
					'value' => (count($node) > 0) ? self::xmlToArr($node, false) : (string) $node
				);
				foreach ($attributes as $attr => $value) {
					$data['attributes'][$attr] = (string) $value;
				}
				if ($totalElement > 1) {
					$array[$element][] = $data;
				} else {
					$array[$element] = $data;
				}
				// Just a value
			} else {
				if ($totalElement > 1) {
					$array[$element][] = self::xmlToArr($node, false);
				} else {
					$array[$element] = self::xmlToArr($node, false);
				}
			}
		}
		if ($root) {
			return array($xml->getName() => $array);
		} else {
			return $array;
		}

	}
}
