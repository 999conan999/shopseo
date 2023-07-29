<?php 
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );
    //**** */ kiểm tra login ở đây
    // var_dump(is_user_logged_in()==false);

    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    if ( ! function_exists( 'wp_crop_image' ) ) {
        include( ABSPATH . 'wp-admin/includes/image.php' );
    }

    function uploade_core($file_arr=array(),$tag){ 
        $rs=array();
        if(count($file_arr)>0){
            foreach($file_arr as $file){
                $uploadedfile = $file;
                $file_type = $uploadedfile['type'];
                $upload_overrides = array(
                    'test_form' => false
                );
                
                $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                // var_dump( $movefile);
                if ( $movefile && ! isset( $movefile['error'] ) ) {
                    $file_path = $movefile['file'];
                    $image_info = getimagesize($file_path);
                    $original_width = $image_info[0];
                    $original_height = $image_info[1];
                    $resized_url300 ='';
                    $resized_url150 ='';
                    $url_og='';
                    $url= $movefile['url'];
                    preg_match_all('/wp-content(.+?)*/',$url, $url_og);
                    $url_og=$url_og[0][0];
                    if ($file_type !== 'image/gif') {
                        // Kiểm tra kích thước hình ảnh và scale thành 300x300 nếu cần thiết
                        if ($original_width > 300 || $original_height > 300) {
                            $editor = wp_get_image_editor($file_path);
                            if (!is_wp_error($editor)) {
                                $editor->resize(300, 300, true);
                                $resized_file = $editor->save();
                                
                                // Lấy đường dẫn tới hình ảnh đã scale
                                $path=$resized_file['path'];
                                preg_match_all('/wp-content(.+?)*/',$path, $resized_url300);
                                $resized_url300 = $resized_url300[0][0];
                                
                                
                                // Thực hiện các xử lý khác với hình ảnh đã scale
                            }else{
                                $resized_url300=$url_og;
                            }
                        }else{
                            $resized_url300=$url_og;
                        }
                        // Kiểm tra kích thước hình ảnh và scale thành 150x150 nếu cần thiết
                        if ($original_width > 150 || $original_height > 150) {
                            $editor = wp_get_image_editor($file_path);
                            if (!is_wp_error($editor)) {
                                $editor->resize(150, 150, true);
                                $resized_file = $editor->save();
                                
                                // Lấy đường dẫn tới hình ảnh đã scale
                                $path=$resized_file['path'];
                                preg_match_all('/wp-content(.+?)*/',$path, $resized_url150);
                                $resized_url150 = $resized_url150[0][0];
                                
                                
                                // Thực hiện các xử lý khác với hình ảnh đã scale
                            }else{
                                $resized_url150=$url_og;
                            }
                        }else{
                            $resized_url150=$url_og;
                        }
                    }else{
                        $resized_url300 =$url_og;
                        $resized_url150 =$url_og;
                    }
                    $tag=$tag==""?"tag":$tag;
                    $data = array(
                        'url'=> $url_og,
                        'url300'=> $resized_url300,
                        'url150'=> $resized_url150,
                        'tag'=> $tag,
                        'title'=> '',
                        'date_create' => current_time('mysql'),
                    );
                    global $wpdb;
                    $table = $wpdb->prefix . 'shopseo_imgs';
                    $kq=$wpdb->insert(
                        $table,
                        $data
                    );
                    $object = new stdClass();
                    if($kq==1){
                        $home=home_url();
                        $lastid = $wpdb->insert_id;
                        $object->id=$lastid;
                        $object->url=$home.'/'.$url_og;
                        $object->url300=$home.'/'.$resized_url300;
                        $object->url150=$home.'/'.$resized_url150;
                        $object->tag=$tag;
                        $object->title='';
                        array_push($rs,$object);
                    }
                    
                } else {
                    /*
                    * Error generated by _wp_handle_upload()
                    * @see _wp_handle_upload() in wp-admin/includes/file.php
                    */
                    // echo $movefile['error'];
                }
            }
        }
        send($rs);
    }
    if(is_user_logged_in()==false){
        if(count($_FILES)>0){
            $result=uploade_core($_FILES,$_POST['tag']);
        }else{
            send(array());
        }
    }
 




















?>