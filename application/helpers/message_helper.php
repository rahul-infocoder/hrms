<?php 
function _set_message($message,$case)
{
    $ci =& get_instance();
    
    switch($case)
    {
        case 'success':
//        $msg = '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success! </strong>'.$message.'</div>';
        $msg = '<div class="alert alert-box success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>'.$message.'</div>';
        $ci->session->set_flashdata('succ_msg', $msg);
        break;
        
        case 'error':
//        $msg = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>'.$message.'</div>';
        $msg = '<div class="alert alert-box error"><a href="#" class="close" data-dismiss="alert">&times;</a>'.$message.'</div>';
        $ci->session->set_flashdata('succ_msg', $msg);
        break;
            
                 case 'notice':
//        $msg = '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error! </strong>'.$message.'</div>';
        $msg = '<div class="alert alert-box notice"><a href="#" class="close" data-dismiss="alert">&times;</a>'.$message.'</div>';
        $ci->session->set_flashdata('succ_msg', $msg);
        break;
            
               
    }
}
?>