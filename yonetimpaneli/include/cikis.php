<?php

@session_destroy();
$VT->yonlendir(SITE."giris-yap");
@ob_end_flush();
exit();
?>
