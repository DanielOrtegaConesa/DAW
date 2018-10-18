<?php

if (!isset($_REQUEST['page'])) {
    include("pages/default.php");
} else {
    include("pages/".$_REQUEST['page'].".php");
}
?>