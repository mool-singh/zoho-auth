<?php


function pr(...$data)
{
   if(!empty($data))
   {
        echo "<pre>";

        foreach($data as $d)
        {
            print_r($d);
        }

        echo "<pre>";
   }
}


function prd(...$data)
{
   if(!empty($data))
   {
        echo "<pre>";

        foreach($data as $d)
        {
            print_r($d);
        }

        echo "<pre>";
   }
   die;
}

function is_active($url)
{
    $CI =& get_instance();
    return ($CI->uri->uri_string() === $url) ? 'active' : '';
}


function is_access_token_expired($datetime)
{
    
    if(empty($datetime))
    {
        return 1;
    }

    $tokenDateTime = new DateTime($datetime);
    
   
    $currentDateTime = new DateTime();
    
    // Calculate the difference between the current time and the token time
    $interval = $currentDateTime->diff($tokenDateTime);
    
    // Convert the difference to minutes
    $minutesPassed = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
    
    // Check if the difference is greater than or equal to 59 minutes
    return $minutesPassed >= 59;
}




function auth_check()
{
    // Get a reference to the controller object
    $ci =& get_instance();
    if(!$ci->session->has_userdata('id'))
    {
        $this->session->set_flashdata('error', "You need to login first");
		return redirect(base_url('login'));
    }
    
}



?>