<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data extends CI_Controller {
    private $user_data;

	function __construct(){
            parent::__construct();
            $this->load->library('grocery_CRUD');	
            $this->load->library('image_CRUD');	
            $this->user_data = $this->session->userdata('user_data');
            if($this->user_data['login'] != "hore"){
                redirect('login');
            }
            $this->get_task($this->user_data);
	}
    
        function get_task($data){
            $query_task = $this->db->get_where('marketing_daily',array('id_boss'=>$data['user_info']->parentId,'status'=>'Open'));
            if($query_task->num_rows() > 0){
                foreach ($query_task->result_array() as $value) {
                    if($this->check_daily_task($value['id'], $data['user_info']->id)){
                        $data_task = array(
                            'id_client'=>$value['id_client'], 
                            'date_start'=>date('Y-m-d').' 06:00:00', 
                            'issue'=>$value['issue'], 
                            'plan'=>$value['plan'],
                            'goal'=>$value['goal'],
                            'class'=>$value['class'],
                            'dateline'=>date('Y-m-d').' 17:00:00', 
                            'status'=>$value['status'], 
                            'note'=>$value['note'],
                            'id_daily'=>$value['id'], 
                            'id_user'=>$data['user_info']->id,
                            'id_boss'=>$data['user_info']->parentId, 
                            'user_created'=>$data['user_info']->parentId, 
                            'date_created'=>$value['date_created']
                        );
                        $this->db->insert('marketing',$data_task);
                    }
                }
            }
        }

        function check_daily_task($id_task,$id_user){
            $Q = "SELECT * FROM (`marketing`) WHERE `id_daily` = '$id_task' AND `id_user` = '$id_user' AND DATE(date_start) = CURDATE()";
            $query = $this->db->query($Q);
//            $query = $this->db->get_where('marketing1',array('id_daily'=>$id_task,'id_user'=>$id_user,'DATE(date_start) = CURDATE()'));
            if($query->num_rows() > 0){
                return false;
            } else {
                return true;
            }
        }
	
	function _home_output($output = null,$view='crud'){
                $output->userinfo = $this->user_data;
		$this->load->view($view,$output);	
	}
	
	function index($output = null){
                $output->userinfo = $this->user_data;
		$this->load->view('home',$output);
	}	
        
        function chechFilterProgress($crud, $x="first"){
            $idUser = null;
            if($x != "first" || !empty($_POST['user'])){
                $user = $this->session->userdata('user');
                $user_data = $this->input->post('user');
                if(!empty($user_data)) {
                    $this->session->set_userdata('user',$user_data);
                    $user = $this->session->userdata('user');
                }
                $idUser    = $user;
            } else {
                $this->session->unset_userdata('user');
                $this->session->set_userdata('user',null);
                $user = $this->session->userdata('user');
                $idUser = $user;
            }
            
            if(!empty($idUser)){
                $crud->where('id_user',$idUser);  
            }
        }
        
        function daily(){
            $crud = new grocery_CRUD(); 
            $crud->set_table('marketing_daily');
            $crud->set_subject('Daily Task');
            $crud->columns('klien','issue','plan','goal','status','user_created');	 
            $crud->display_as('id_client','client')->display_as('date_start','Starting date')->display_as('id_user','User')->display_as('klien','Client');
            $crud->set_rules("id_client", "Client", "xss_clean|trim|required");
            $crud->set_rules("issue", "Issue", "xss_clean|trim|required");
            $crud->set_rules("plan", "Plan", "xss_clean|trim|required");
            $crud->set_rules("goal", "Goal", "xss_clean|trim|required");
            $crud->set_rules("status", "Status", "xss_clean|trim|required");
            $crud->callback_column('klien',array($this,'_client'));
            $crud->callback_column('date_start',array($this,'_urgentIcon'));
            $crud->callback_column('status',array($this,'_statusIcon'));
            $crud->callback_column('user_created',array($this,'_boss'));
            $crud->set_relation('id_client','client','client');
            $crud->set_width('status','100');
            $crud->field_type('id', 'hidden'); 
            $crud->field_type('id_boss', 'hidden',$this->user_data['user_info']->id); 
            $crud->where('id_boss',$this->user_data['user_info']->id);
            $crud->callback_after_insert(array($this, '_email_task_send'));
            $crud->callback_before_update(array($this, '_update_status'));
            $this->HiddenField($crud);
            $output = $crud->render(); 
            $this->_home_output($output);
        }
	
	function progress($state='first',$id,$notes=""){
            $crud = new grocery_CRUD(); 
            $this->chechFilterProgress($crud, $state);
            
            $sel_user = $this->input->post('user');
            $data = array();
            if($this->user_data['user_info']->role != 1){
                $query = $this->db->get('user');
                $data = $query->result_array();
            } else {
                $data[] = array('id'=>$this->user_data['user_info']->id,'name'=>$this->user_data['user_info']->name);
            }
            
            $crud->set_table('marketing');
//            $this->HiddenField($crud);
            $crud->columns('date_start','klien','issue','plan','goal','dateline','time','update','status','user_created');	 
            $crud->display_as('id_client','client')->display_as('date_start','Starting date')->display_as('id_user','User')->display_as('klien','Client');
            $crud->set_rules("id_client", "Client", "xss_clean|trim|required");
            $crud->set_rules("issue", "Issue", "xss_clean|trim|required");
            $crud->set_rules("plan", "Plan", "xss_clean|trim|required");
            $crud->set_rules("goal", "Goal", "xss_clean|trim|required");
            $crud->set_rules("status", "Status", "xss_clean|trim|required");
            $crud->set_rules("date_start", "Start Time", "xss_clean|trim|required|callback__update_status");
            $crud->set_rules("dateline", "End Time", "xss_clean|trim|required|callback_checkAppointmentTime");
//            $crud->set_width('issue', '400');
//            $crud->set_width('plan', '400');
//            $crud->set_width('goal', '400');
            $crud->set_subject($notes.' Progress');
            $crud->set_relation('id_client','client','client');
            $crud->required_fields('id_user');
            if($this->user_data['user_info']->role == 1){
//                $crud->set_relation('id_user','user','name',array('id'=>$this->user_data['user_info']->id));
                $crud->where('id_user',$this->user_data['user_info']->id);
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
//                $crud->unset_view();
//                echo uri_string();
//                $crud->callback_delete(array($this,'delete_user'));
                #$crud->add_action('View Report', base_url().'assets/img/view.png', 'data/report','ui-icon-image');
       	         $crud->field_type('id_user','hidden',$this->user_data['user_info']->id);
            } else {
                
                $crud->field_type('id_user','hidden',$id);
//                $crud->set_relation('id_user','user','name',array('parentId'=>$this->user_data['user_info']->id));
                $crud->where('id_user',$id);
                #$crud->add_action('View Report', base_url().'assets/img/view.png', 'data/report_view','ui-icon-image');
            }
            
            if($this->user_data['user_info']->role != 1){
            	if($this->user_data['user_info']->role == 2){
              	  $crud->where('id_boss',$this->user_data['user_info']->id);
       	         $crud->field_type('id_boss','hidden',$this->user_data['user_info']->id);
	       }
	     } else {
       	         $crud->field_type('id_boss','hidden',$this->user_data['user_info']->parentId);
             }

            $crud->field_type('id_daily','hidden');
            $crud->callback_column('klien',array($this,'_client'));
            $crud->callback_column('update',array($this,'_viewReport'));
            $crud->callback_column('date_start',array($this,'_urgentIcon'));
            $crud->callback_column('status',array($this,'_statusIcon'));
            $crud->callback_column('time',array($this,'_time'));
            $crud->callback_column('user_created',array($this,'_boss'));
            $crud->set_width('status','100');
            $crud->order_by('date_start','desc');
            $crud->edit_fields(
                'id_client', 
                'date_start', 
                'issue', 
                'plan', 
                'goal', 
                'class', 
                'dateline', 
                'update', 
                'status', 
                'note', 
                'id_user',
                'id'
            );
            
            $crud->field_type('id', 'hidden'); 
            $crud->callback_after_insert(array($this, '_email_task_send'));
            $crud->callback_before_update(array($this, '_update_status'));
//            $crud->callback_before_delete(array($this, '_delete_task'));
            $this->HiddenField($crud);
            $output = $crud->render(); 
            $output->users = $data;
            $output->sel_user = $sel_user;
            $output->notes = $notes;
            $this->_home_output($output,'crud_marketing');
	}
	
	function checkAppointmentTime()
	{		
            
		$starttime = $this->input->post("date_start");
		$endtime = $this->input->post("dateline");
		
		$sArray = explode(":",$starttime);
		$eArray = explode(":",$endtime);
				
		if($eArray[0] > $sArray[0])
		{
//			$this->form_validation->set_message("checkAppointmentTime","The %s is greater than the Start time. Please use a valid time.");
			return TRUE;
		}
		
		if($eArray[0] == $sArray[0]) // hours same
		{
			if($eArray[1] <= $sArray[1]) // minutes same
			{
				$this->form_validation->set_message("checkAppointmentTime","The %s is equal to the Start time. Please use a valid time.");
				return FALSE;
			}			
		}
                
				
		if($eArray[0] < $sArray[0])
		{
			$this->form_validation->set_message("checkAppointmentTime","The %s is less than the Start time. Please use a valid time.");
			return FALSE;
		}
		return false;
	}	
 
        function _action($primary_key,$row){
            $img =  "<a href='".  uri_string().'/view/'.$row->id."'>".img('assets/img/magnifier.png')."</a> ";
            $img .=  "<a href='".  uri_string().'/edit/'.$row->id."'>".img('assets/img/edit.png')."</a> ";
            $img .=  "<a href='".  uri_string().'/delete/'.$row->id."'>".img('assets/img/close.png')."</a>";
            return $img;
        }
 
        function _boss($primary_key,$row){
            $query = $this->db->get_where('user',array('id'=>$row->user_created));
            if($query->num_rows() > 0){
                $data = $query->row_array();
                return $data['name'];
            } else {
                return '';
            }
        }
        
        function _time($primary_key,$row){
            $time = '';
            if($row->time != ""){
                $datetime = explode("-",strip_tags($row->date_start));
                $date = explode("/", str_replace(" ", "", $datetime[0]));
                $date1 = $date[2]."-".$date[1]."-".$date[0]." ".str_replace(" ", "",$datetime[1]).":00";
                $datetime1 = strtotime(date('Y-m-d', strtotime($date1)));
                $date2 = str_replace('/', '-',$row->time);
                $datetime2 = strtotime(date('Y-m-d', strtotime($date2)));
                $time =  timespan($datetime1, $datetime2);
            }
            return $time;
        }
        
        function _client($primary_key,$row){
            $query = $this->db->get_where('client',array('id'=>$row->id_client));
            $data = $query->row();
            $link = anchor('client/progress/'.$row->id_client, $data->client);
            return $link;
        }
	
	function report($id_task){
            $crud = new grocery_CRUD(); 
            $crud->set_table('report');
            $crud->where('task_id', $id_task);
            $crud->columns('task_id','descr','dt');	 
            $crud->set_subject('Management Report');
            $crud->set_rules("descr", "Description", "xss_clean|trim|required");
            $crud->set_rules("dt", "Date", "xss_clean|trim|required");
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->field_type('task_id', 'hidden',$id_task);
            $crud->set_relation('task_id','marketing','issue'); 
            $crud->callback_after_insert(array($this, '_email_report_task_send'));
            $crud->callback_after_update(array($this, '_email_report_task_send'));
            $output = $crud->render(); 
            $this->_home_output($output);
	}
	
	function report_user($id_user){
            $query = $this->db->get_where('user',array('id'=>$id_user));
            $data_user = $query->row;
            $crud = new grocery_CRUD(); 
            $crud->set_table('report');
            $crud->where('task_id', $id_user);
            $crud->columns('task_id','descr','dt');	 
            $crud->set_subject('Management Report : '. $data_user->name);
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->set_relation('task_id','marketing','issue'); 
            $output = $crud->render(); 
            $this->_home_output($output);
	}
	
	function report_view($id_task){
            $crud = new grocery_CRUD(); 
            $crud->set_table('report');
            $crud->where('task_id', $id_task);
            $crud->columns('task_id','descr','dt');	 
            $crud->set_subject('Management Report');
            $crud->display_as('descr','Description')->display_as('dt','Date')->display_as('task_id','Task');
            $crud->field_type('task_id', 'hidden',$id_task);
            $crud->set_relation('task_id','marketing','issue'); 
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $output = $crud->render(); 
            $this->_home_output($output);
	}
        
        function _userLink($value){
            return $value."asdasd";
        }
        
        function _urgentIcon($value,$row){
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get_where('report',array('task_id'=>$row->id));
            if($query->num_rows() > 0){
                $data_last_report = $query->row_array();
                $diff = strtotime($data_last_report['dt']) - strtotime($row->dateline);
            } else {
                $diff = now() - strtotime($row->dateline);
            }
            
            
            $days = floor($diff / 86400);
            
            if($days > 0){
                $img =  img('assets/img/urgent1.png');
            } else {
                $img =  img('assets/img/ok.png');
            }
            $date = $img.' '.date('d/m/Y - H:i',  strtotime($value));
            return $date;
        }
        
        function _viewReport($value,$row){

            	if($this->user_data['user_info']->role == 1){
	            	$img =  "<a href='".site_url('data/report/'.$row->id)."'>".img('assets/img/view.png')."</a>";
		} else {
	            	$img =  "<a href='".site_url('data/report_view/'.$row->id)."'>".img('assets/img/view.png')."</a>";
		}

            	return $img;
        }

        
        function _statusIcon($value){            
            if($value == 'Open'){
                $img =  img('assets/img/open.png');
            } else {
                $img =  img('assets/img/closed.png');
            }
//            $view = '<a href="'.  site_url('data/report_view').'">'.img('assets/img/view.png')."</a>";
            return $img;
        }
        
	function HiddenField($crud){
//            $crud->field_type('user_created', 'hidden','');
//            $crud->field_type('date_created', 'hidden',''); 
            $crud->field_type('user_updated', 'hidden','');
            $crud->field_type('date_updated', 'hidden',''); 
            $crud->field_type('time', 'hidden',''); 
            $url = explode('/',uri_string());
            if(isset($url[5])){
                if($url[5] == 'add'){ 
                    $crud->field_type('user_created', 'hidden',$this->user_data['user_info']->id);
                    $crud->field_type('date_created', 'hidden',date("Y-m-d H:i:s"));     
                } elseif($url[5] == 'edit') { 
                    $crud->field_type('user_updated', 'hidden',$this->user_data['user_info']->id);
                    $crud->field_type('date_updated', 'hidden',date("Y-m-d H:i:s"));        
                } else {
                    $crud->field_type('user_created', 'hidden',$this->user_data['user_info']->id);
                    $crud->field_type('date_created', 'hidden',date("Y-m-d H:i:s"));    
                }
            } else {
                $crud->field_type('user_created', 'hidden',$this->user_data['user_info']->id);
                $crud->field_type('date_created', 'hidden',date("Y-m-d H:i:s"));    
            }
        }	
        
        function _delete_task($primary_key){
            $query_task = $this->db->get_where('marketing',array('id'=>$primary_key));
            $data_task = $query_task->row();
            if($data_task->user_created == $this->user_data['user_info']->id){
                return true;
            } else {
                $this->form_validation->set_message("_delete_task","This user can't edit or delete task");
                return false;
            }
        }
        
        function _update_status($post_array,$primary_key){
            $query_task = $this->db->get_where('marketing',array('id'=>$_POST['id']));
            if($query_task->num_rows() > 0){
                $data_task = $query_task->row();
//                echo $data_task->user_created." => ".$this->user_data['user_info']->id;
//                die();
                if($data_task->user_created == $this->user_data['user_info']->id){
                    if($post_array['status'] == "Close"){
                        $data_waktu = array(
                            'time'=>date("Y-m-d h:i:s"),
                            'date_updated'=>date("Y-m-d h:i:s"),
                            'user_updated'=>$this->user_data['user_info']->id
                        );
                    } else {
                        $data_waktu = array(
                            'time'=>null,
                            'date_updated'=>date("Y-m-d h:i:s"),
                            'user_updated'=>$this->user_data['user_info']->id
                        );
                    }
                    $this->db->where('id',$primary_key);
                    $this->db->update('marketing',$data_waktu);
                    return true;
                } else {
                    $this->form_validation->set_message("_update_status","This user can't edit or delete task");
                    return false;
                }
            } else {
                return true;
            }
        }
        
        function _email_task_send($post_array,$primary_key){
            $email_config = Array(
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n",
                'smtp_crypto'=>'tls'
            );
            
            $data = array(
                'user_updated'=>date("Y-m-d h:i:s"),
                'date_created'=>$this->user_data['user_info']->id
            );
            $this->db->where('id',$primary_key);
            $this->db->update('marketing',$data);
            
            $query_task = $this->db->get_where('marketing',array('id'=>$primary_key));
            $data_task = $query_task->row();
            
            $query_user = $this->db->get_where('user',array('id'=>$data_task->id_user));
            $data_user = $query_user->row();
            
            $query_boss = $this->db->get_where('user',array('id'=>$data_task->id_boss));
            $data_boss = $query_boss->row();
            
            $this->load->library('email',$email_config);
            $this->email->from('task@fergaco.com', 'Task Management');
            $this->email->to($data_user->email,$data_user->name);
            $this->email->cc($data_boss->email,$data_boss->name);
	if($data_boss->email == 'firman@fergaco.com'){
	            $this->email->cc('desy@fergaco.com','Desy');
	}
            
            $this->email->subject('New Task : '.$data_task->issue.' ( '.$data_task->date_start.' -'.$data_task->dateline.' )');
            
            $html = '
                <table border="0">
                    <tr>
                        <td width="200" style="vertical-align: top;">Starting Date</td>
                        <td width="10" style="vertical-align: top;">:</td>
                        <td>'.date("d M Y",  strtotime($data_task->date_start)).' - '.date("d M Y",  strtotime($data_task->dateline)).' </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Issue</td>
                        <td style="vertical-align: top;">:</td>
                        <td>'.$data_task->issue.'</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Plan</td>
                        <td style="vertical-align: top;">:</td>
                        <td>'.$data_task->plan.'</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Goal</td>
                        <td style="vertical-align: top;">:</td>
                        <td>'.$data_task->goal.'</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Class</td>
                        <td>:</td>
                        <td>'.$data_task->class.'</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Note</td>
                        <td>:</td>
                        <td>'.$data_task->note.'</td>
                    </tr>
                </table>';
            $this->email->message($html);
            $this->email->send();
        }
        
        function _email_report_task_send($post_array,$primary_key){
            $email_config = Array(
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n",
                'smtp_crypto'=>'tls'
            );
            
            $query_report = $this->db->get_where('report',array('id'=>$primary_key));
            $data_report = $query_report->row();
            
            $query_task = $this->db->get_where('marketing',array('id'=>$data_report->task_id));
            $data_task = $query_task->row();
            
            $query_user = $this->db->get_where('user',array('id'=>$data_task->id_user));
            $data_user = $query_user->row();
            
            $query_boss = $this->db->get_where('user',array('id'=>$data_task->id_boss));
            $data_boss = $query_boss->row();
            
            $this->load->library('email',$email_config);
            $this->email->from('task@fergaco.com', 'Task Management');
            $this->email->to($data_boss->email,$data_boss->name);
	if($data_boss->email == 'firman@fergaco.com'){
	            $this->email->cc('desy@fergaco.com','Desy');
	}
            
            $this->email->subject('Report Task : '.$data_task->issue.' ('.$data_user->name.')');
            
            $html = '
                <table border="0">
                    <tr>
                        <td width="200" style="vertical-align: top;">Date</td>
                        <td width="10" style="vertical-align: top;">:</td>
                        <td>'.date("d M Y",  strtotime($data_report->dt)).'</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Report</td>
                        <td style="vertical-align: top;">:</td>
                        <td>'.$data_report->descr.'</td>
                    </tr>
                </table>';
            $this->email->message($html);
            $this->email->send();
        }
}