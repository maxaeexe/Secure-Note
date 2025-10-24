<?php
class view {
        public static function show($viewName, $data = []) {
            extract($data);
        
        $file = "view/" . $viewName . ".php";

        if (file_exists($file)) {
            include($file);
        } else {
            include("view/404.php");
        }
    }
}
?>
