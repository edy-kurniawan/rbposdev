<?php
class ceklogin {
  if ($this->session->userdata['logged'] == TRUE)
        {
            //do something
        }
        else
        {
        	$this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
			redirect('login');
        }  
}
?>