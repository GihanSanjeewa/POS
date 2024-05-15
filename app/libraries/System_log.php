<?php
/**
 * Created by PhpStorm.
 * User: S.Priyadarshan
 * Date: 07-Jul-16
 * Time: 12:19 PM
 */
?>
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * System_log
 *
 * Implementation by S.Priyadarshan
 *
 * @package    CodeIgniter
 * @subpackage libraries
 * @category   library
 * @version    1.0 <beta>
 * @author     S.Priyadarshan
 */
class System_log
{
    public function __construct()
    {
        $this->load->library('ion_auth');
        $this->load->model('system_log_mod');
        date_default_timezone_set("Asia/Colombo");
        $this->current_time = date('Y-m-d H:i:s');
    }
    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function create_system_log($action, $status, $log_message, $user_id = null)
    {
        /* Last parameter $user_id is needed to create system log for user logout.
        This is because, after the user logout ion_auth user id cannot be referred. */
        $current_user_id = $user_id == null ? $this->ion_auth->user()->row()->id : $user_id;
        $admin_log = array(
            'user_id' => $current_user_id,
            'date_time' => $this->current_time,
            'ip_address' => $this->input->ip_address(),
            'action' => $action,
            'status' => $status,
            'log_message' => $log_message
        );
        $this->system_log_mod->create_system_log($admin_log);
    }
}
/* End of file System_log.php */
/* Location: ./app/libraries/System_log.php */