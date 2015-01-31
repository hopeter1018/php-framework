<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ComposerScripts;

/**
 * Consolidated Shortcuts to all system writable paths
 *
 * @version $id$
 * @author peter.ho
 */
final class PostCreateProject implements IComposerScripts
{

	public static function run()
	{
		$filepath = APP_WORKBENCH_ROOT . "application/setup.php";
		if (is_file($filepath)) {
			file_put_contents(
				$filepath,
				str_replace(
					array("define('APP_CRYPT_KEY', '');", "define('APP_HASH_KEY', '');"),
					array("define('APP_CRYPT_KEY', '" . Hopeter1018\Helper\String::randomString() . "');", "define('APP_HASH_KEY', '" . Hopeter1018\Helper\String::randomString() . "');"),
					file_get_contents($filepath)
				)
			);
		}
	}

}
