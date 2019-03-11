<?php

namespace CMS\Modules\Counter;

use CMS\Functions\Load\Module as ModuleExtended;

class Counter extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function IsVisitorBot2() {
        // Tableau des adresses ip
        $al_IPtab[] = '66.249.'; // Googlebot
        $al_IPtab[] = '207.68.146.'; // MSN Bot
        $al_IPtab[] = '65.54.188.'; // MSN Bot
        $al_IPtab[] = '66.196.'; // Yahoo
        $al_IPtab[] = '68.142.'; // Yahoo
        $al_IPtab[] = '195.101.94.'; // Voila
        $al_IPtab[] = '64.241.243.65'; // Wisenut
        $al_IPtab[] = '209.249.67.1'; // Wisenut
        $al_IPtab[] = '64.241.242.177'; // Wisenut
        $al_IPtab[] = '66.77.73.'; // Fast
        $al_IPtab[] = '62.212.117.198'; // Deepindex
        $al_IPtab[] = '65.214.36.'; // Teoma
        $al_IPtab[] = '65.214.38.10'; // Teoma
        $al_IPtab[] = '212.127.141.180'; // Whalhello
        $al_IPtab[] = '213.73.184.'; // Whalhello
        $al_IPtab[] = '216.243.113.1'; // Gigablast
        $al_IPtab[] = '217.205.60.225'; // Mirago
        $al_IPtab[] = '62.119.21.157'; // picsearch
        $al_IPtab[] = '193.218.115.6'; // Szukacz
        $al_IPtab[] = '210.59.144.149'; // Openfind
        $al_IPtab[] = '66.237.60.22'; // Openfind
        $al_IPtab[] = '218.145.25.'; // Naver
        // Vérifie chaque adresse
        if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
            for ($al_t = 0, $al_max = count($al_IPtab); $al_t < $al_max; ++$al_t) {
                if (strpos($_SERVER['REMOTE_ADDR'], $al_IPtab[$al_t]) === 0) {
                    return true;
                }
            }
        }
        return false;
    }

    public function new_visit($title, $id) {
        $al_ip = md5($_SERVER['REMOTE_ADDR']);
        $al_time = date('Ymd');
        $al_text = $al_ip . ":" . $al_time . ":";
        $al_filename = 'Modules/Counter/visit/counter2.txt';
        $al_file_content1 = file_get_contents($al_filename);
        $al_explode_file_content = explode(":", $al_file_content1);
        if(isset($al_explode_file_content[1])){
			if ($al_time > $al_explode_file_content[1]) {
				$al_handle2 = fopen($al_filename, "w");
				fwrite($al_handle2, " ");
				fclose($al_handle2);
			}
		}
        //write in the file
        $al_handle = fopen($al_filename, "r");
        $al_contents = fread($al_handle, filesize($al_filename));
        fclose($al_handle);
        $al_explode1 = explode(":", $al_contents);
        $al_count1 = count($al_explode1);
        $al_j = 0;
        $al_fp = fopen($al_filename, "a");
        for ($al_i = 0; $al_i < $al_count1; $al_i++) {
            $al_without_space = str_replace(' ', '', $al_explode1[$al_i]);
            if ($al_without_space == $al_ip) {
                //remove double
                $al_j = 1;
                break;
            }
            $al_i++;
        }
        $al_testing_bot = $this->IsVisitorBot2();
        if ($al_j == '1' || $al_testing_bot == true) {
            
        } else {
            if (filesize($al_filename) < 5000000) {
                fwrite($al_fp, $al_text);
                $al_filename_path = 'Modules/Counter/visit/counter.txt';
                $al_file_content = file_get_contents($al_filename_path);
                $al_handle2 = fopen($al_filename_path, "w");
                fwrite($al_handle2, $al_file_content + 1);
                fclose($al_handle2);
            }
        }
        fclose($al_fp);
        //reading file for showing
        $al_filename_path = 'Modules/Counter/visit/counter.txt';
        $al_file_content1 = file_get_contents($al_filename_path);
        $al_filename_path2 = 'Modules/Counter/visit/counter2.txt';
        $al_file_open = fopen($al_filename_path2, "r");
        $al_contents2 = fread($al_file_open, filesize($al_filename_path2));
        fclose($al_file_open);
        $al_y1 = 0;
        $al_explode2 = explode(":", $al_contents2);
        $al_count2 = count($al_explode2);
        for ($al_i = 0; $al_i < $al_count2; $al_i++) {
            if ($al_explode2[$al_i] == $al_time) {
                $al_y1++;
            }
        }

		$display = $this->system_model->init("Counter", "Display");
		$module = $display->new_visit_select(['id' => $id]);
		
		$this->system_view->init('Counter', 'Counter');
		$this->system_view->assign('al_fetch_module', $module);
		$this->system_view->assign('title', $title);
		$this->system_view->assign('al_y1', $al_y1);
		$this->system_view->assign('al_file_content1', $al_file_content1);
		return $this->system_view->render();
    }

//this function mut start with "load_" and end with the name of the module folder
    public function load_counter($id, $category, $title, $params) {
		$al_options = $params['counter'];
		$title = !empty($al_options['show_title']) ? true : false;
		
        $view = $this->new_visit($title, $id);
        return $view;
    }

}

?>