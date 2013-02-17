<?php 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type:application/vnd.ms-excel");
header("Content-Transfer-Encoding: binary");

?>
<?php echo $content_for_layout ?>