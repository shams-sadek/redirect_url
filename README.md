# redirect_url
Redirect Url With Post Data

Example 

<?php

use App\Libraries\RedirectUrl;

require __DIR__ . '/vendor/autoload.php';


ob_start();

include 'Forms/MyForm.php';



if($_POST) {

    $obj = new RedirectUrl;
    $obj->setUrl('received.php')
        ->setPostData($_POST);

    $obj->submitByGet();
}
