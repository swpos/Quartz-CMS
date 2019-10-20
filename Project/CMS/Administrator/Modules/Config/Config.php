<?php

namespace CMS\Administrator\Modules\Config;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Config extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function configuration_listed() {
		$listed = $this->system_model->init("Config", "Listed");
		$al_fetch_config = $listed->configurationListed([]);
		        
        $this->system_view->init('Config', 'Config');
        $this->system_view->assign('al_fetch_config', $al_fetch_config);
        $this->system_view->assign('timezones', $this->generate_timezone_list());
		
        return $this->system_view->render();
    }
	
	public function update_cms_post () {
		exec("cd ".$_SERVER['DOCUMENT_ROOT']."../../ && if test -d .git/; then rm -R .git/; fi");
		exec("cd ".$_SERVER['DOCUMENT_ROOT']."../../ && git init && git remote add origin https://github.com/quartzcms/Quartz-CMS && git fetch --all && git reset --hard origin/master");
		exec("cd ".$_SERVER['DOCUMENT_ROOT']."../../ && php composer.phar self-update && php composer.phar update");
	}
	
	public function update_cms () {
		$content_repo = file('https://raw.githubusercontent.com/quartzcms/Quartz-CMS/master/Project/CMS/Languages/Admin/En/Panel.php');
		foreach($content_repo as $key => $value){
			if(strpos($value, 'Quartz CMS') !== false){
				preg_match('/Version\s([0-9\.]+)/', $value, $matches);
			}
		}
		
		$project_content = file_get_contents('https://raw.githubusercontent.com/quartzcms/Quartz-CMS/master/composer.json');
		$detect = 0;
		exec("cd ".$_SERVER['DOCUMENT_ROOT']."../../ && cat composer.json 2>&1", $content_composer, $return_var);
		$extension = [];
		foreach($content_composer as $key => $value){
			if($detect == 1){
				$name = explode("\"", $value);
				if(!isset($name[1])){
					break;
				}
				
				if(strpos($project_content, $name[1]) === false){
					$extension[] = $name[1];
				}
			}
			if(strpos($value, 'require') !== false){
				$detect = 1;
			}
		}
		
		$content = file('../Languages/Admin/En/Panel.php');
		foreach($content as $key => $value){
			if(strpos($value, 'Quartz CMS') !== false){
				preg_match('/Version\s([0-9\.]+)/', $value, $matches2);
			}
		}
        $this->system_view->init('Config', 'Update');
		$this->system_view->assign('repo_version', $matches[1]);
		$this->system_view->assign('cms_version', $matches2[1]);
		$this->system_view->assign('extension', $extension);
        return $this->system_view->render();
	}

    public function configuration_listed_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$listed = $this->system_model->init("Config", "Listed");
		
        if (empty($post['al_password'])) {
            include('../config.php');
            $al_password2 = $al_password;
        } else {
			$al_password2 = $post['al_password'];
		}
					
		$info = [
			'data' => [
				'title' => $post['title'],
				'emailadmin' => $post['emailadmin'],
				'pause' => $post['pause'],
				'allow_regis' => $post['allow_regis'],
				'regis_link' => $post['regis_link'],
				'forbidden_pages' => $post['forbidden_pages'],
				'forbidden_actions' => $post['forbidden_actions'],
				'except_admin' => $post['except_admin']
			],
			'where' => ['id' => '1']
		];
		
		$listed->configurationUpdate($info);

		if (file_exists('../config.php')) {
			$al_fp = fopen('../config.php', 'w');
		} else {
			$al_fp = fopen('../config.php', 'a');
		}

		fwrite($al_fp, '<?php ' . "\n");
		fwrite($al_fp, '$al_host = "' . $post['al_host'] . '"; ' . "\n");
		fwrite($al_fp, '$al_user = "' . $post['al_user'] . '"; ' . "\n");
		fwrite($al_fp, '$al_password = "' . $al_password2 . '"; ' . "\n");
		fwrite($al_fp, '$al_db_name = "' . $post['al_db_name'] . '";' . "\n");
		fwrite($al_fp, '$prefix_table = "' . $post['al_hash'] . '";' . "\n");
		fwrite($al_fp, '$al_type_mysql = "mysql"; ' . "\n");
		fwrite($al_fp, '$editor = "' . $post['editor'] . '"; ' . "\n");
		fwrite($al_fp, '$session_domain = "' . $post['session_domain'] . '"; ' . "\n");
		fwrite($al_fp, '$session_time = "' . $post['session_time'] . '"; ' . "\n");
		fwrite($al_fp, '$session_path = "' . $post['session_path'] . '"; ' . "\n");
		fwrite($al_fp, '$timezone = "' . $post['timezone'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_type = "' . $post['mailer_type'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_host = "' . $post['mailer_host'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_auth = "' . $post['mailer_auth'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_username = "' . $post['mailer_username'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_password = "' . $post['mailer_password'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_from = "' . $post['mailer_from'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_html = "' . $post['mailer_html'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_secure = "' . $post['mailer_secure'] . '"; ' . "\n");
		fwrite($al_fp, '$mailer_port = "' . $post['mailer_port'] . '"; ' . "\n");
		fwrite($al_fp, '?>');
		fclose($al_fp);
    }
	
	public function generate_timezone_list(){
		static $regions = array(
			\DateTimeZone::AFRICA,
			\DateTimeZone::AMERICA,
			\DateTimeZone::ANTARCTICA,
			\DateTimeZone::ASIA,
			\DateTimeZone::ATLANTIC,
			\DateTimeZone::AUSTRALIA,
			\DateTimeZone::EUROPE,
			\DateTimeZone::INDIAN,
			\DateTimeZone::PACIFIC,
		);
	
		$timezones = array();
		foreach($regions as $region){
			$timezones = array_merge($timezones, \DateTimeZone::listIdentifiers($region));
		}
	
		$timezone_offsets = array();
		foreach($timezones as $timezone){
			$tz = new \DateTimeZone($timezone);
			$timezone_offsets[$timezone] = $tz->getOffset(new \DateTime);
		}
	
		// sort timezone by offset
		asort($timezone_offsets);
	
		$timezone_list = array();
		foreach($timezone_offsets as $timezone => $offset){
			$offset_prefix = $offset < 0 ? '-' : '+';
			$offset_formatted = gmdate('H:i', abs($offset));
			$pretty_offset = "UTC${offset_prefix}${offset_formatted}";
			$timezone_list[$timezone] = "(${pretty_offset}) $timezone";
		}
	
		return $timezone_list;
	}
}

?>