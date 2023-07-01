<?php
    $type='page';
    $search_text= stripslashes(strip_tags($_GET['s']));
    $sp=get_data_search($search_text);
    $home_url=get_home_url();
    $home_name=str_replace('https://', '', $home_url);
    $home_name=str_replace('http://', '', $home_name);
    $thumnail=$common->logo_icon;
    $canatical="noindex, nofollow, max-snippet:-1, max-image-preview:large, max-video-preview:-1";
    if($sp){
        $thumnail=$sp[0]->thumnail->url;
        // if(count($sp)>9) $canatical="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1";
    }
?>
<?php

 

?>