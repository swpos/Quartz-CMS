<?php

namespace CMS\Libraries\Classes\Extended;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use CMS\Libraries\Classes\Standard as Standard;

class Config extends Standard {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function loadvariable() {
		$al_fetch_config = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_config')
				->execute()
			);
        $al_title_page = empty($al_fetch_config) ? "" : $al_fetch_config->title;
        return $al_title_page;
    }
	
	public function loadconfig() {
		$al_fetch_config = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_config')
				->execute()
			);
        $al_config = empty($al_fetch_config) ? [] : $al_fetch_config;
        return $al_config;
    }

    public function loadtitle_admin() {
		$returned_value = empty($_GET['page']) ? "" : $_GET['page'];
        return $returned_value;
    }
	
	public function loadtitle_site($al_title_page) {
		$al_title_page = empty($al_title_page) ? "index" : $al_title_page;
		
		$al_fetch_title_article = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_link_menu')
				->where('shortcut = ?')
				->setParameter(0, $al_title_page)
				->execute()
			);

        $al_title_page = empty($al_fetch_title_article) ? "" : $al_fetch_title_article->name;
        return $al_title_page;
    }
	
	public function ifpause() {
		$al_fetch_title = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_config')
				->execute()
			);
        $al_pause = empty($al_fetch_title) ? "0" : $al_fetch_title->pause;
        if ($al_pause == '1') {
            return true;
        } else {
            return false;
        }
    }
	
	public function ifLinkUnpublished($shortcut) {
        if ($shortcut == "") {
            return false;
        }
		
		$al_fetch_title = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_link_menu')
				->where('shortcut = ?')
				->setParameter(0, $shortcut)
				->execute()
			);
			
        $id_index = !empty($al_fetch_title) ? $al_fetch_title->id_index : 0;
        $published = !empty($al_fetch_title) ? $al_fetch_title->published : 0;
				
        if ($id_index == '0' || $published == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buildMenu() {
        $menu = '
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="index.php?page=Panel&action=panel">'.$this->loadvariable().'</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				  <ul class="nav navbar-nav">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">'. MENU_TOP_MODULES .' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=Module&action=module">'. MENU_TOP_MODULES .'</a></li>
						<li><a href="index.php?page=Module&action=module_add">'. MENU_TOP_MODULES_ADD_MODULE .'</a></li>
					  </ul>
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">'. MENU_TOP_ARTICLE .' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=Article&action=article_listed_article">'. MENU_TOP_ARTICLE .'</a></li>
						<li><a href="index.php?page=Article&action=article_add_article">'. MENU_TOP_ARTICLE_ADD_ARTICLE .'</a></li>
					  </ul>
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">'. MENU_TOP_USERS .' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=User&action=user_listed">'. MENU_TOP_USERS .'</a></li>
						<li><a href="index.php?page=User&action=user_add_user">'. MENU_TOP_USERS_ADD_USER .'</a></li>
					  </ul>
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">'. MENU_TOP_MENU .' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=Menu&action=menu_listed">'. MENU_TOP_MENU .'</a></li>
						<li><a href="index.php?page=Menu&action=menu_add_link">'. MENU_TOP_ADD_LINK .'</a></li>
					  </ul>
					</li>
					<li><a href="index.php?page=Template&action=template_listed">'. MENU_TOP_TEMPLATES .'</a></li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">'. MENU_TOP_CONFIGURATION .' <span class="caret"></span></a>
					  	<ul class="dropdown-menu" role="menu">
							<li><a href="index.php?page=Config&action=configuration_listed">'. MENU_TOP_CONFIGURATION .'</a></li>
							<li><a href="index.php?page=Config&action=update_cms">'. MENU_TOP_CONFIGURATION_UPDATE .'</a></li>
						</ul>
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">'. MENU_TOP_PLUGINS .' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=Plugin&action=plugin_add">'. MENU_TOP_ADD_PLUGIN .'</a></li>
						<li><a href="index.php?page=Plugin&action=plugin_listed">'. MENU_TOP_LIST_PLUGINS .'</a></li>';
						
						$al_fetch_plugins = 
							$this->data->getData(
								$this->db->createQueryBuilder()
								->select('*')
								->from(HASH.'_plugins')
								->where('publish = ?')
								->setParameter(0, '1')
								->execute()
							);

						foreach ((is_array($al_fetch_plugins) ? $al_fetch_plugins : array($al_fetch_plugins)) as $plugin) {
							$plugin_default_link = $plugin->default_shortcut;
							$plugin_title = $plugin->title;
							$plugin_page = ucfirst($plugin->content);
							if(strlen($plugin_default_link) > 1){
								$menu .= "<li><a href='index.php?page=$plugin_page&action=$plugin_default_link'>$plugin_title</a></li>";
							}
						}
						$menu .= '
						</ul>
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">'. MENU_TOP_MEDIA .' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=Media&action=media">'. MENU_TOP_MEDIA_ADD_MEDIA .'</a></li>
						<li><a href="index.php?page=Media&action=media_show">'. MENU_TOP_MEDIA_SHOW_MEDIA .'</a></li>
					  </ul>
					</li>
					
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. MENU_TOP_LANGUAGES .' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=Language&action=changelang&lang=fr">Français</a></li>
						<li><a href="index.php?page=Language&action=changelang&lang=en">English</a></li>
						<li><a href="index.php?page=Language&action=language_edit">'. MENU_TOP_EDIT_LANGUAGES .'</a></li>
					  </ul>
					</li>
				  </ul>
				  <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.MENU_TOP_VIEW_SITE.' <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="../index.php" target="_blank">'.MENU_TOP_VIEW_SITE.'</a></li>
						<li><a href="index.php?page=Login&action=login_disconnect">'.MENU_TOP_DISCONNECT.'</a></li>
					  </ul>
					</li>
				  </ul>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		';
        return $menu;
    }
	
	public function mailer($recipient, $subject, $message, $headers) {
		$mailer_type = "mail";
		if(file_exists('../config.php')){
			include('../config.php');
		}
		$mailer = 'mail_'. $mailer_type;
		return $this->$mailer($recipient, $subject, $message, $headers);
	}
	
	public function mail_mail($recipient, $subject, $message, $headers) {
		return mail($recipient, $subject, $message, $headers);
	}
	
	public function mail_smtp($recipient, $subject, $message, $headers) {
		if(file_exists('../config.php')){
			include('../config.php');
		
			// Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);
			
			try {
				//Server settings
				$mail->SMTPDebug = false;                      // Enable verbose debug output
				$mail->isSMTP();                                            // Send using SMTP
				$mail->Host       = $mailer_host;                    // Set the SMTP server to send through
				$mail->SMTPAuth   = filter_var($mailer_auth, FILTER_VALIDATE_BOOLEAN);                                   // Enable SMTP authentication
				$mail->Username   = $mailer_username;                     // SMTP username
				$mail->Password   = $mailer_password;                               // SMTP password
				$mail->SMTPSecure = $mailer_secure;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
				$mail->Port       = $mailer_port;                                   // TCP port to connect to
			
				//Recipients
				$mailer_from = explode(';',$mailer_from);
				$mail->setFrom($mailer_from[0], $mailer_from[1]);
				$mail->addAddress($recipient);
				$mail->addReplyTo($mailer_from[0], $mailer_from[1]);
				
				// Content
				$mail->isHTML(filter_var($mailer_html, FILTER_VALIDATE_BOOLEAN));                                  // Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $message;
				$mail->AltBody = strip_tags($message);
			
				$mail->send();
				//echo 'Message has been sent';
			} catch (Exception $e) {
				//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}
	}

    public function plugins($id) {
		$al_fetch_plugins = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_plugins')
				->where('publish = ?')
				->setParameter(0, $id)
				->execute()
			);
		
        $plugin_array = array();
        foreach ((is_array($al_fetch_plugins) ? $al_fetch_plugins : array($al_fetch_plugins)) as $plugins) {
            $plugin = array();
            $plugin['id'] = $plugins->id;
            $plugin['title'] = $plugins->title;
            $plugin['date'] = $plugins->date;
            $plugin['time'] = $plugins->time;
            $plugin['default_shortcut'] = $plugins->default_shortcut;
            $plugin['content'] = $plugins->content;
            $plugin['publish'] = $plugins->publish;
            $plugin_array[] = $plugin;
        }

        return $plugin_array;
    }

    public function full_url() {
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0;
        return
                ($https ? 'https://' : 'http://') .
                (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
                (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
                        ($https && $_SERVER['SERVER_PORT'] === 443 ||
                        $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT'])));
    }

    public function full_path() {
        return $_SERVER['DOCUMENT_ROOT'];
    }

}

?>