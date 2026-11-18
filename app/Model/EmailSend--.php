<?php App::uses('CakeEmail', 'Network/Email');
/* This model use for manage email system.Send mail.*/
class EmailSend extends AppModel 
{
	var $useTable = false; //i dont have a table right now.

	/**
	 * Used to send registration mail to employee
	 *
	 * @access public
	 * @param array $employee employee detail
	 * @return void
	 */
	public function employeeRegistrationMail($employee) {
		$emailId= $employee['User']['email'];
		////
		$Email = new CakeEmail();
		$Email->template('registration_mail');
		$Email->emailFormat('html');
		$Email->to($emailId);
		$Email->subject('OAPFMP: Your registration is complete');
		$Email->from(array('oapfmpsupport@nic.in' => 'OAPFMP Support'));
		$Email->viewVars(array('name' => ucfirst($employee['User']['f_name'].' ').ucfirst($employee['User']['l_name']), 'empcode'=>$employee['User']['username'],'password'=>$employee['User']['password'],'emailfrom'=>'OAPFMP'));
		try{
			$result = $Email->send();
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send registration email to User with email id-".$emailId;
		}
		$this->log($result, LOG_DEBUG);
		return;
	}
	
	/*	public function employeeForgotPasswordMail($employee) {
		$emailId= $employee['Employee']['email'];
		////
		$Email = new CakeEmail('gmail');
		$Email->template('forgot_password_mail');
		$Email->emailFormat('html');
		$Email->to($emailId);
		$Email->subject('IWAI: Your password has been reset.');
		$Email->from(array('nikhil.nikh172222@gmail.com' => 'IWAI'));
		$Email->viewVars(array('name' => ucfirst($employee['Employee']['employee_first_name'].' ').ucfirst($employee['Employee']['employee_last_name']), 'empcode'=>$employee['Employee']['employee_code'],'password'=>$employee['Employee']['password'],'emailfrom'=>'IWAI'));
		try{
			$result = $Email->send();
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send forgot password email to Employee-".$emailId;
		}
		$this->log($result, LOG_DEBUG);
		return;
	}*/
        
        public function employeeForgotPasswordMail($employee) {
		$emailId= $employee['User']['email'];
		////
		$Email = new CakeEmail();
		$Email->template('forgot_password_mail');
		$Email->emailFormat('html');
		$Email->to($emailId);
		$Email->subject('OAPFMP: Password Assistance.');
		$Email->from(array('oapfmpsupport@nic.in' => 'OAPFMP Support'));
		$Email->viewVars(array(
                                        'name' => ucfirst($employee['User']['f_name'].' ').ucfirst($employee['User']['l_name']),
                                        'mail_key'=>$employee['User']['mail_key'],
                                        'forget_password_key'=>$employee['User']['forget_password_key'],
                                        'emailfrom'=>'OAPFMP'
                                        )
                                );
		try{
			$result = $Email->send();
		} catch (Exception $ex){
			// we could not send the email, ignore it
			$result="Could not send password assistance email to user with email -".$emailId;
		}
		$this->log($result, LOG_DEBUG);
		return;
	}
}
?>