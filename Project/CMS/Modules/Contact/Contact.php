<?php

namespace CMS\Modules\Contact;

use CMS\Functions\Load\Module as ModuleExtended;

class Contact extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_contact($id, $category, $title, $params) {
        $this->system_view->init('Contact', 'Contact');
        $this->system_view->assign('category', $id);
        $this->system_view->assign('params', $params);
        $this->system_view->assign('page', $this->v->_g('page'));
        return $this->system_view->render();
    }

    public function post_contact() {
		$post = $this->v->_pA();
		$get = $this->v->_gA();
		
		$display = $this->system_model->init("Contact", "Display");
		
        $error = '';
		$form = $this->system_form->init('contact', ['contact' => ['id_module','date','time','first_name','last_name','email','phone','postal_code','city','states','country','daybirth','monthbirth','yearbirth','gender','content','shortcut']], 'send', $post);
        $al_captcha = $this->v->d(strtolower($_POST['captcha']));

        if ($al_captcha == "15") {
			$contact_config = $display->post_contact_select([]);
			
            $al_send_email_admin = $contact_config->send_email_admin;
            $al_send_complete_mail = $contact_config->send_complete_mail;
            $al_send_users = $contact_config->users;
            $al_send_users_array = explode(',', $al_send_users);

            if ($al_send_complete_mail == 'yes') {
                $al_content_message = "
				First name : " . $form['contact']['first_name'] . "<br />
				Last name : " . $form['contact']['last_name'] . "<br />
				Email : " . $form['contact']['email'] . "<br />
				Phone : " . $form['contact']['phone'] . "<br />
				Postal code : " . $form['contact']['postal_code'] . "<br />
				City : " . $form['contact']['city'] . "<br />
				State : " . $form['contact']['states'] . "<br />
				Country : " . $form['contact']['country'] . "<br />
				Date of birth : " . $form['contact']['daybirth'] . "/" . $form['contact']['monthbirth'] . "/" .$form['contact']['yearbirth'] . "<br />
				Gender : " . $form['contact']['gender'] . "<br />
				
				MESSAGE : " . $form['contact']['content'];
            } else {
                $al_content_message = "
				First name : " . $form['contact']['first_name'] . "<br />
				Last name : " . $form['contact']['last_name'] . "<br />
				
				MESSAGE : " . $form['contact']['content'];
            }

            if ($al_send_email_admin == 'yes') {
				$contact = $display->post_contact_select2([]);
                $al_email_webmaster = $contact->email;
                $subject = 'Contact Form - ' . $this->system_config->loadvariable();
                $message = 'A message from the contact form on the website. Here is the content : <br />' . $al_content_message;
                $headers = 'From: ' . $form['contact']['email'] . "\r\n" .
                        'Reply-To: ' . $form['contact']['email'] . "\r\n" .
                        'MIME-Version: 1.0' . "\r\n" .
						'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                $this->system_config->mailer($al_email_webmaster, $subject, $message, $headers);
            } else {
                $subject = 'Contact Form - ' . $this->system_config->loadvariable();
                $message = 'A message from the contact form on the website. Here is the content : <br />' . $al_content_message;
                $headers = 'From: ' . $form['contact']['email'] . "\r\n" .
                        'Reply-To: ' . $form['contact']['email'] . "\r\n" .
                        'MIME-Version: 1.0' . "\r\n" .
						'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                foreach ($al_send_users_array as $email) {
                    $this->system_config->mailer($email, $subject, $message, $headers);
                }
            }
			$display->post_contact_insert($form['contact']);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

}

?>