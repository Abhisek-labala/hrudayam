<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 function __construct(){
			parent:: __construct();					
			$this->load->library('session');
			/*if ( ! $this->session->userdata('admin_id'))
			{   
			//redirect(base_url().$indexPage.'/admin-login');
			redirect(base_url().$indexPage.'/Welcome');
			}*/		
		}
	 
	 
	public function index()
	{
		$this->load->view('index.php');
	}

	public function loginTest()
	{
		$this->load->view('loginTest.php');
	}

	public function educatorLoginAuth2()
	{
		$this->load->view('loginTest.php');
	}

	public function pform()
	{
		$this->load->view('p_form.php');
	}
	
	
	public function adminLogin()
	{
		$this->load->view('admin/login.php');
	}

	public function misLogin()
	{
		$this->load->view('mis/login.php');
	}
	public function digitaleducatorLogin()
	{
		$this->load->view('digitaleducator/login');
	}
	public function digitalYogaDieticialLogin()
	{
		$this->load->view('yogadietician/login');
	}
	public function loginAuth()
	{		
		$email			= trim($_POST['email']);
		$password		= trim($_POST['password']);	
		
		if (empty($email)) {
			$error = "Email is required.";
			redirect(base_url().'/Digital-Educator-login');
		} 
		
		// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// 	$this->session->set_flashdata('error','Please Enter Email');
		// 	redirect(base_url().'/Digital-Educator-login');
		// 	die();
		// } 

		if (empty($password)) {
			$this->session->set_flashdata('error','Please Enter Password');
			redirect(base_url().'/Digital-Educator-login');
			die();
		} 
		
		if($email && $password){
			$loginDataArray = array();
			$loginDataArray['emp_id'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('digital_educator',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('digital_educator_id', $login_data->id);
				$this->session->set_userdata('type', 'digital_educator');
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'digital_educator';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				//redirect(base_url().'/Patient-Information');
				redirect(base_url().'/Digital-Educator-Dashboard');
				
			}else{		
 

				$loginDataArray['emp_id'] 	= $email;
				$loginDataArray['password'] = $password;
				$emp_login_data = $this->master_model->getRow('digital_educator',$loginDataArray);

				if($emp_login_data){
					
					$login_logs = array(); 
					$login_logs['email'] = $email;
					$login_logs['type'] = 'digital_educator';
					$login_logs['ip'] = get_client_ip();
					$this->master_model->save('login_logs',$login_logs);
					
					
					$this->session->set_userdata('digital_educator_id', $emp_login_data->id);
					$this->session->set_userdata('type', 'digital_educator');
								
					//redirect(base_url().'/Patient-Information');
					//redirect(base_url().'/Patient-Information');
					redirect(base_url().'/Digital-Educator-Dashboard');
				}

			$this->session->set_flashdata('error','Invalid Details');
			redirect(base_url().'/Digital-Educator-login');
			die();
			}
			
		}else{			
			$this->session->set_flashdata('error','Please Enter Email and Password');
			redirect(base_url().'/Digital-Educator-login');
			die();
		}
	}
	public function loginAuth2()
	{		
		$email			= trim($_POST['email']);
		$password		= trim($_POST['password']);	
		
		if (empty($email)) {
			$error = "Email is required.";
			redirect(base_url().'/Digital-YogaDieticial-login');
		} 
		
		// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// 	$this->session->set_flashdata('error','Please Enter Email');
		// 	redirect(base_url().'/Digital-YogaDieticial-login');
		// 	die();
		// } 

		if (empty($password)) {
			$this->session->set_flashdata('error','Please Enter Password');
			redirect(base_url().'/Digital-YogaDieticial-login');
			die();
		} 
		
		if($email && $password){
			$loginDataArray = array();
			$loginDataArray['emp_id'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('digital_yoga_dietician',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('digital_yoga_dietician_id', $login_data->id);
				$this->session->set_userdata('type', 'digital_yoga_dietician');
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'digital_yoga_dietician';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				//redirect(base_url().'/Patient-Information');
				redirect(base_url().'/Digital-Educator-Dashboard');
				
			}else{		
 

				$loginDataArray['emp_id'] 	= $email;
				$loginDataArray['password'] = $password;
				$emp_login_data = $this->master_model->getRow('digital_yoga_dietician',$loginDataArray);

				if($emp_login_data){
					
					$login_logs = array(); 
					$login_logs['email'] = $email;
					$login_logs['type'] = 'digital_yoga_dietician';
					$login_logs['ip'] = get_client_ip();
					$this->master_model->save('login_logs',$login_logs);
					
					
					$this->session->set_userdata('digital_yoga_dietician_id', $emp_login_data->id);
					$this->session->set_userdata('type', 'digital_yoga_dietician');
								
					//redirect(base_url().'/Patient-Information');
					//redirect(base_url().'/Patient-Information');
					redirect(base_url().'/Digital-Educator-Dashboard');
				}

			$this->session->set_flashdata('error','Invalid Details');
			redirect(base_url().'/Digital-YogaDieticial-login');
			die();
			}
			
		}else{			
			$this->session->set_flashdata('error','Please Enter Email and Password');
			redirect(base_url().'/Digital-YogaDieticial-login');
			die();
		}
	}
	public function misLoginAuth()
	{		
		$email			= trim($_POST['email']);
		$password		= trim($_POST['password']);			
		
		if($email && $password){
			$loginDataArray = array();
			$loginDataArray['email'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('mis',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('mis_id', $login_data->id);
				$this->session->set_userdata('type', 'mis'); 
				//return redirect()->to('/admin-dashboard');
				
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'mis';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				
				redirect(base_url().'/mis-dashboard'); 
			}else{

				$loginDataArray = array();
				$loginDataArray['user_name'] 	= $email;
				$loginDataArray['password'] = $password;
				$login_data = $this->master_model->getRow('mis',$loginDataArray);
				unset($loginDataArray);
				
				if($login_data){
					$this->session->set_userdata('mis_id', $login_data->id);
					$this->session->set_userdata('type', 'mis'); 
					//return redirect()->to('/admin-dashboard');
					
					
					$login_logs = array(); 
					$login_logs['email'] = $email;
					$login_logs['type'] = 'mis';
					$login_logs['ip'] = get_client_ip();
					$this->master_model->save('login_logs',$login_logs); 
					unset($login_logs);
					
					
					redirect(base_url().'/mis-dashboard'); 
				}

			//return redirect()->back()->with('error', 'Invalid password');
			redirect(base_url().'/mis-login');
			}
			
		}else{
			//return redirect()->back()->with('error', 'Please Enter Email and Password');
			redirect(base_url().'/mis-login');
		}
	}

	public function pmLogin()
	{
		$this->load->view('pm/login.php');
	}

	public function pmLoginAuth()
	{		
		$email			= trim($_POST['email']);
		$password		= trim($_POST['password']);			
		
		if($email && $password){
			$loginDataArray = array();
			$loginDataArray['email'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('pm',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('pm_id', $login_data->id);
				$this->session->set_userdata('type', 'pm'); 
				//return redirect()->to('/admin-dashboard');
				
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'pm';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				
				redirect(base_url().'/pm-dashboard');
			}else{

			$loginDataArray = array();
			$loginDataArray['user_name'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('pm',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('pm_id', $login_data->id);
				$this->session->set_userdata('type', 'pm'); 
				//return redirect()->to('/admin-dashboard');
				
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'pm';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				
				redirect(base_url().'/pm-dashboard');
			}else{
			//return redirect()->back()->with('error', 'Invalid password');
			redirect(base_url().'/pm-login');
			}
			//return redirect()->back()->with('error', 'Invalid password');
			redirect(base_url().'/pm-login');
			}
			
		}else{

			

			//return redirect()->back()->with('error', 'Please Enter Email and Password');
			redirect(base_url().'/pm-login');
		}
	}

	
	
	public function adminLoginAuth()
	{		
		$email			= trim($_POST['email']);
		$password		= trim($_POST['password']);			
		
		if($email && $password){
			$loginDataArray = array();
			$loginDataArray['email'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('admin',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('admin_id', $login_data->id);
				$this->session->set_userdata('type', 'admin'); 
				//return redirect()->to('/admin-dashboard');
				
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'admin';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				
				redirect(base_url().'/admin-dashboard');
			}else{
			//return redirect()->back()->with('error', 'Invalid password');
			redirect(base_url().'/admin-login');
			}
			
		}else{
			//return redirect()->back()->with('error', 'Please Enter Email and Password');
			redirect(base_url().'/admin-login');
		}
	}


	// public function educatorLoginOld()
	// {
	// 	$this->load->view('educator/login.php');
	// }
	
	
	// public function educatorLoginAuthOld()
	// {		
	// 	$email			= trim($_POST['email']);
	// 	$password		= trim($_POST['password']);			
		
	// 	if($email && $password){
	// 		$loginDataArray = array();
	// 		$loginDataArray['email'] 	= $email;
	// 		$loginDataArray['password'] = $password;
	// 		$login_data = $this->master_model->getRow('educator',$loginDataArray);
	// 		unset($loginDataArray);
			
	// 		if($login_data){
	// 			$this->session->set_userdata('educator_id', $login_data->id);				
	// 			//redirect(base_url().'/Educator-Dashboard');
	// 			redirect(base_url().'/Patient-Information');
	// 		}else{
	// 		//return redirect()->back()->with('error', 'Invalid password');
	// 		redirect(base_url().'/Educator-login');
	// 		}
			
	// 	}else{
	// 		//return redirect()->back()->with('error', 'Please Enter Email and Password');
	// 		redirect(base_url().'/Educator-login');
	// 	}
	// } 


	public function educatorLogin()
	{
		$this->load->view('educator/login.php');
	}
	
	
	public function educatorLoginAuth()
	{		
		$email			= trim($_POST['email']);
		$password		= trim($_POST['password']);	
		
		if (empty($email)) {
			$error = "Email is required.";
			redirect(base_url().'/Educator-login');
		} 
		
		// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// 	$this->session->set_flashdata('error','Please Enter Email');
		// 	redirect(base_url().'/Educator-login');
		// 	die();
		// } 

		if (empty($password)) {
			$this->session->set_flashdata('error','Please Enter Password');
			redirect(base_url().'/Educator-login');
			die();
		} 
		
		if($email && $password){
			$loginDataArray = array();
			$loginDataArray['email'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('educator',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('educator_id', $login_data->id);
				$this->session->set_userdata('type', 'educator');
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'educator';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				//redirect(base_url().'/Patient-Information');
				redirect(base_url().'/Educator-Dashboard');
				
			}else{		
 

				$loginDataArray['emp_id'] 	= $email;
				$loginDataArray['password'] = $password;
				$emp_login_data = $this->master_model->getRow('educator',$loginDataArray);

				if($emp_login_data){
					
					$login_logs = array(); 
					$login_logs['email'] = $email;
					$login_logs['type'] = 'educator';
					$login_logs['ip'] = get_client_ip();
					$this->master_model->save('login_logs',$login_logs);
					
					
					$this->session->set_userdata('educator_id', $emp_login_data->id);
					$this->session->set_userdata('type', 'educator');
								
					//redirect(base_url().'/Patient-Information');
					//redirect(base_url().'/Patient-Information');
					redirect(base_url().'/Educator-Dashboard');
				}

			$this->session->set_flashdata('error','Invalid Details');
			redirect(base_url().'/Educator-login');
			die();
			}
			
		}else{			
			$this->session->set_flashdata('error','Please Enter Email and Password');
			redirect(base_url().'/Educator-login');
			die();
		}
	}


	public function rmLogin()
	{
		$this->load->view('rm/login.php');
	}
	
	
	public function rmLoginAuth()
	{		
		$email			= trim($_POST['email']);
		$password		= trim($_POST['password']);	
		
		if (empty($email)) {
			$error = "Email is required.";
			redirect(base_url().'/rm-login');
		} 
		
		// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// 	$this->session->set_flashdata('error','Please Enter Email');
		// 	redirect(base_url().'/Educator-login');
		// 	die();
		// } 

		if (empty($password)) {
			$this->session->set_flashdata('error','Please Enter Password');
			redirect(base_url().'/rm-login');
			die();
		} 
		
		if($email && $password){
			$loginDataArray = array();
			$loginDataArray['username'] 	= $email;
			$loginDataArray['password'] = $password;
			$login_data = $this->master_model->getRow('rm_name',$loginDataArray);
			unset($loginDataArray);
			
			if($login_data){
				$this->session->set_userdata('rm_id', $login_data->id);
				$this->session->set_userdata('type', 'rm');
				
				$login_logs = array(); 
				$login_logs['email'] = $email;
				$login_logs['type'] = 'rm';
				$login_logs['ip'] = get_client_ip();
				$this->master_model->save('login_logs',$login_logs); 
				unset($login_logs);
				
				redirect(base_url().'RM-Dashboard');
			}else{		
 

				// $loginDataArray['username'] 	= $email;
				// $loginDataArray['password'] = $password;
				// $emp_login_data = $this->master_model->getRow('rm_name',$loginDataArray);

				// if($emp_login_data){
					
				// 	$login_logs = array(); 
				// 	$login_logs['email'] = $email;
				// 	$login_logs['type'] = 'rm';
				// 	$login_logs['ip'] = get_client_ip();
				// 	$this->master_model->save('login_logs',$login_logs);
					
					
				// 	$this->session->set_userdata('rm_id', $emp_login_data->id);
				// 	$this->session->set_userdata('type', 'rm');
								
				// 	redirect(base_url().'RM-Dashboard');
				// }

			$this->session->set_flashdata('error','Invalid Details');
			redirect(base_url().'/rm-login');
			die();
			}
			
		}else{			
			$this->session->set_flashdata('error','Please Enter Email and Password');
			redirect(base_url().'/rm-login');
			die();
		}
	}
	
	
	public function getStateCity(){

		if (isset($_POST['state'])) {
			
			// $educatorId = $_POST['value'];
			// $doctorsData = getDoctorByEducator($educatorId);
			// $doctorsData = $doctorsData['doctorsData'];

			//pr($doctorsData['doctorsData']);
			//die();

			$stateCode = $_POST['state'];
			$query = "SELECT * FROM `all_cities` WHERE `state_code`='".$stateCode."' ORDER BY `city_name`";
			$cityData = $this->master_model->customQueryArray($query);			
			?>

			<option value="" id=""> ---Select City---- </option>			
			<?php 
			if($cityData) { 
				foreach($cityData as $key=> $Item){
					//pr($doctorsItem);
					$name= $Item['city_name'];
					$city_code= $Item['city_code'];					
					$id = $Item['id'];
					?>
					<option value="<?php echo $id?>" id="city_<?php echo $city_code?>"> <?php echo $name?> </option>	
					<?php
				}
			}
		}
		die();

	}
	
	
}
