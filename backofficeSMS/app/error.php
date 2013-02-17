<?php
 
class AppError extends ErrorHandler {
 
        function error404($params) {
                $this->controller->layout = "Error";
                parent::error404($params);
        }
 
}
 
?>