<?php

namespace CMS\Libraries\Classes\Standard;

class Pagination {

    public function get_pagination($total) {
		$page = isset($_GET['k']) ? $_GET['k'] : "";
        $item = "20";
        if ($page == "") {
            $page = 0;
        }
        $start = $page * $item;
        if ($start == "") {
            $start = 0;
        }
		if($total > 20){
        	return "LIMIT ". $start . "," . $item;
		} else {
			return "";
		}
    }

    public function pagination($total) {
		$page = isset($_GET['page']) ? $_GET['page'] : "";		
		$action = isset($_GET['action']) ? $_GET['action'] : "";		
		$k = isset($_GET['k']) ? $_GET['k'] : "";		
        if ($page) {
            $page = "?page=" . $page . "&action=" . $action . "&k=";
        } else {
            $page = "?k=";
        }
        $array = array();
        $item = "20";
        if ($k == "") {
            $k = 0;
        }
        $start = $k * $item;
        $start = ($start == "") ? 0 : $start;
		
        $pagination = "";
        $pagination .= "<nav><ul class='pagination'>";
        if ($k > 0) {
            $previous = $k - 1;
            $pagination .= "<li><a href='index.php" . $page . $previous . "'><< " . PREVIOUS . "</a></li>";
        }
        $i = 0;
        $j = 1;
        if ($total > $item) {
            while ($i < ceil((is_array($total) ? count($total) : $total) / $item)) {
                if ($i != $k) {
                    $pagination .= "<li><a href='index.php" . $page . $i . "'>$j</a></li>";
                } else {
                    $pagination .= "<li><a href='#'><b>$j</b></a></li>";
                }
                $i++;
                $j++;
            }
        }
        if ($start + $item < $total) {
            $next = $k + 1;
            $pagination .= "<li><a href='index.php" . $page . $next . "'>" . NEXT . " >></a></li>";
        }
        $pagination .= "</ul></nav>";
        return $pagination;
    }

}
?>