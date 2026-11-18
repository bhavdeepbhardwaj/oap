<?php
App::uses('AppController', 'Controller');

class UploadFilesController extends AppController {
	
	 public function beforeFilter() {
     $this->Security->csrfCheck = false;
	 $this->Security->unlockedActions=array('check_exists_profile_pics','upload_profile_pic','upload_profile_sign','check_exists_advt_pdf','upload_advt_pdf','check_exists_write_up_pdf','upload_write_up_pdf','check_exists_doc_pdf','upload_doc_pdf','check_exists_applicant_acrs','upload_applicant_acrs');

	  
    }
	

	
	

	public function check_exists_profile_pics()
	{
		
		$this->autoRender=false;
		
		$targetFolder = '/uploads/userimages/'; // Relative to the root and should match the upload folder in the uploader script

		if (file_exists( WWW_ROOT . $targetFolder . '/' . $_POST['filename'])) {
			echo 1;
		} else {
			echo 0;
		}	
		die;
	}
	
	
		
	
	
	
	
	public function upload_profile_pic()
	{
		$this->autoRender=false;
		if($this->request->is('post'))
		{
				
			$uploadDir = '/uploads/userimages/';
			$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
			$verifyToken = md5('oOlnb%unique_saltui#876ghWWzxa' . $this->request->data['timestamp']);				
				
			if (!empty($_FILES) && $this->request->data['token'] == $verifyToken) 
			{				
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
				$uploadDir  =  WWW_ROOT . $uploadDir;
				

				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				if(strpos($fileParts['filename'],'.'))
				{
					throw new RuntimeException('Found more than one extension.');
				}
				if (in_array(strtolower($fileParts['extension']), $fileTypes))
				{				
					try {
	   
						// Undefined | Multiple Files | $_FILES Corruption Attack
						// If this request falls under any of them, treat it invalid.
						if (
							!isset($_FILES['Filedata']['error']) ||
							is_array($_FILES['Filedata']['error'])
						) {
							throw new RuntimeException('Invalid parameters.');
						}

						// Check $_FILES['upfile']['error'] value.
						switch ($_FILES['Filedata']['error']) {
							case UPLOAD_ERR_OK:
								break;
							case UPLOAD_ERR_NO_FILE:
								throw new RuntimeException('No file sent.');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE:
								throw new RuntimeException('Exceeded filesize limit.');
							default:
								throw new RuntimeException('Unknown errors.');
						}

						// You should also check filesize here.
						if ($_FILES['Filedata']['size'] > 4000000) {
							throw new RuntimeException('Exceeded filesize limit.');
						}

						// DO NOT TRUST $_FILES['Filedata']['mime'] VALUE !!
						// Check MIME Type by yourself.
						$finfo = new finfo(FILEINFO_MIME_TYPE);
						if (false === $ext = array_search(
							$finfo->file($tempFile),
							array(
								'jpg' => 'image/jpeg',
								'png' => 'image/png',
								'gif' => 'image/gif'	
							),
							true
						)) {
							throw new RuntimeException('Invalid file format.');
						}
	
						// You should name it uniquely.
						// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$NewFileName=sha1_file($tempFile).rand(1,100).'.'.$ext;
						$targetFile = $uploadDir.$NewFileName;
						if (!move_uploaded_file($tempFile,$targetFile)) 
						{
							throw new RuntimeException('Failed to move uploaded file.');
						}
						else
						{
								$this->Session->write('new_uploaded_profile_pic',$NewFileName);
								echo 'uploaded_ok_'.$NewFileName;
							
							
							
						}	

					} catch (RuntimeException $e) {

						echo $e->getMessage();

					}
				
				}
				else
				{
					echo 'Invalid file type.';
				}
			}	
		}
	}
	
	//public function upload_profile_pic_add_employee()
	public function upload_profile_sign()
	{
		$this->autoRender=false;
		if($this->request->is('post'))
		{
				
			$uploadDir = '/uploads/userimages/';
			$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
			$verifyToken = md5('oOlnb%unique_saltui#876ghWWzxa' . $this->request->data['timestamp']);				
				
			if (!empty($_FILES) && $this->request->data['token'] == $verifyToken) 
			{				
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
				$uploadDir  =  WWW_ROOT . $uploadDir;
				

				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				if(strpos($fileParts['filename'],'.'))
				{
					throw new RuntimeException('Found more than one extension.');
				}
				if (in_array(strtolower($fileParts['extension']), $fileTypes))
				{				
					try {
	   
						// Undefined | Multiple Files | $_FILES Corruption Attack
						// If this request falls under any of them, treat it invalid.
						if (
							!isset($_FILES['Filedata']['error']) ||
							is_array($_FILES['Filedata']['error'])
						) {
							throw new RuntimeException('Invalid parameters.');
						}

						// Check $_FILES['upfile']['error'] value.
						switch ($_FILES['Filedata']['error']) {
							case UPLOAD_ERR_OK:
								break;
							case UPLOAD_ERR_NO_FILE:
								throw new RuntimeException('No file sent.');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE:
								throw new RuntimeException('Exceeded filesize limit.');
							default:
								throw new RuntimeException('Unknown errors.');
						}

						// You should also check filesize here.
						if ($_FILES['Filedata']['size'] > 4000000) {
							throw new RuntimeException('Exceeded filesize limit.');
						}

						// DO NOT TRUST $_FILES['Filedata']['mime'] VALUE !!
						// Check MIME Type by yourself.
						$finfo = new finfo(FILEINFO_MIME_TYPE);
						if (false === $ext = array_search(
							$finfo->file($tempFile),
							array(
								'jpg' => 'image/jpeg',
								'png' => 'image/png',
								'gif' => 'image/gif'	
							),
							true
						)) {
							throw new RuntimeException('Invalid file format.');
						}
	
						// You should name it uniquely.
						// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$NewFileName=sha1_file($tempFile).rand(1,100).'.'.$ext;
						$targetFile = $uploadDir.$NewFileName;
						if (!move_uploaded_file($tempFile,$targetFile)) 
						{
							throw new RuntimeException('Failed to move uploaded file.');
						}
						else
						{
								$this->Session->write('new_uploaded_profile_sign',$NewFileName);
								echo 'uploaded_ok_'.$NewFileName;
							
							
							
						}	

					} catch (RuntimeException $e) {

						echo $e->getMessage();

					}
				
				}
				else
				{
					echo 'Invalid file type.';
				}
			}	
		}
	}	

  public function check_exists_advt_pdf()
	{
		
		$this->autoRender=false;
		
		$targetFolder = '/uploads/advertisements/'; // Relative to the root and should match the upload folder in the uploader script

		if (file_exists( WWW_ROOT . $targetFolder . '/' . $_POST['filename'])) {
			echo 1;
		} else {
			echo 0;
		}	
		die;
	}
	
	
	public function upload_advt_pdf()
	{
		$this->autoRender=false;
		if($this->request->is('post'))
		{
				
			$uploadDir = '/uploads/advertisements/';
			$fileTypes = array('pdf'); // Allowed file extensions
			$verifyToken = md5('oOlnb%unique_saltui#876ghWWzxa' . $this->request->data['timestamp']);				
				
			if (!empty($_FILES) && $this->request->data['token'] == $verifyToken) 
			{				
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
				$uploadDir  =  WWW_ROOT . $uploadDir;
				

				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				if(strpos($fileParts['filename'],'.'))
				{
					throw new RuntimeException('Found more than one extension.');
				}
				if (in_array(strtolower($fileParts['extension']), $fileTypes))
				{				
					try {
	   
						// Undefined | Multiple Files | $_FILES Corruption Attack
						// If this request falls under any of them, treat it invalid.
						if (
							!isset($_FILES['Filedata']['error']) ||
							is_array($_FILES['Filedata']['error'])
						) {
							throw new RuntimeException('Invalid parameters.');
						}

						// Check $_FILES['upfile']['error'] value.
						switch ($_FILES['Filedata']['error']) {
							case UPLOAD_ERR_OK:
								break;
							case UPLOAD_ERR_NO_FILE:
								throw new RuntimeException('No file sent.');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE:
								throw new RuntimeException('Exceeded filesize limit.');
							default:
								throw new RuntimeException('Unknown errors.');
						}

						// You should also check filesize here.
						if ($_FILES['Filedata']['size'] > 4000000) {
							throw new RuntimeException('Exceeded filesize limit.');
						}

						// DO NOT TRUST $_FILES['Filedata']['mime'] VALUE !!
						// Check MIME Type by yourself.
						$finfo = new finfo(FILEINFO_MIME_TYPE);
						if (false === $ext = array_search(
							$finfo->file($tempFile),
							array(
								'pdf' => 'application/pdf'	
							),
							true
						)) {
							throw new RuntimeException('Invalid file format.');
						}
	
						// You should name it uniquely.
						// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$NewFileName=sha1_file($tempFile).rand(1,100).'.'.$ext;
						$targetFile = $uploadDir.$NewFileName;
						if (!move_uploaded_file($tempFile,$targetFile)) 
						{
							throw new RuntimeException('Failed to move uploaded file.');
						}
						else
						{
							echo 'uploaded_ok_'.$NewFileName;
						}	

					} catch (RuntimeException $e) {

						echo $e->getMessage();

					}
				
				}
				else
				{
					echo 'Invalid file type.';
				}
			}	
		}
	}	
	
	
	//Write Up Uploading
	public function upload_write_up_pdf()
	{
		$this->autoRender=false;
		if($this->request->is('post'))
		{
				
			$uploadDir = '/uploads/write_ups/';
			$fileTypes = array('pdf'); // Allowed file extensions
			$verifyToken = md5('oOlnb%unique_saltui#876ghWWzxa' . $this->request->data['timestamp']);				
				
			if (!empty($_FILES) && $this->request->data['token'] == $verifyToken) 
			{				
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
				$uploadDir  =  WWW_ROOT . $uploadDir;
				

				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				if(strpos($fileParts['filename'],'.'))
				{
					throw new RuntimeException('Found more than one extension.');
				}
				if (in_array(strtolower($fileParts['extension']), $fileTypes))
				{				
					try {
	   
						// Undefined | Multiple Files | $_FILES Corruption Attack
						// If this request falls under any of them, treat it invalid.
						if (
							!isset($_FILES['Filedata']['error']) ||
							is_array($_FILES['Filedata']['error'])
						) {
							throw new RuntimeException('Invalid parameters.');
						}

						// Check $_FILES['upfile']['error'] value.
						switch ($_FILES['Filedata']['error']) {
							case UPLOAD_ERR_OK:
								break;
							case UPLOAD_ERR_NO_FILE:
								throw new RuntimeException('No file sent.');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE:
								throw new RuntimeException('Exceeded filesize limit.');
							default:
								throw new RuntimeException('Unknown errors.');
						}

						// You should also check filesize here.
						if ($_FILES['Filedata']['size'] > 4000000) {
							throw new RuntimeException('Exceeded filesize limit.');
						}

						// DO NOT TRUST $_FILES['Filedata']['mime'] VALUE !!
						// Check MIME Type by yourself.
						$finfo = new finfo(FILEINFO_MIME_TYPE);
						if (false === $ext = array_search(
							$finfo->file($tempFile),
							array(
								'pdf' => 'application/pdf'	
							),
							true
						)) {
							throw new RuntimeException('Invalid file format.');
						}
	
						// You should name it uniquely.
						// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$NewFileName=sha1_file($tempFile).rand(1,100).'.'.$ext;
						$targetFile = $uploadDir.$NewFileName;
						if (!move_uploaded_file($tempFile,$targetFile)) 
						{
							throw new RuntimeException('Failed to move uploaded file.');
						}
						else
						{
							echo 'uploaded_ok_'.$NewFileName;
						}	

					} catch (RuntimeException $e) {

						echo $e->getMessage();

					}
				
				}
				else
				{
					echo 'Invalid file type.';
				}
			}	
		}
	}
	
	//Check exists
	public function check_exists_write_up_pdf()
	{
		
		$this->autoRender=false;
		
		$targetFolder = '/uploads/write_ups/'; // Relative to the root and should match the upload folder in the uploader script

		if (file_exists( WWW_ROOT . $targetFolder . '/' . $_POST['filename'])) {
			echo 1;
		} else {
			echo 0;
		}	
		die;
	}
	
	  //Uploading Documents
	   public function upload_doc_pdf()
	{
		$this->autoRender=false;
		if($this->request->is('post'))
		{
				
			$uploadDir = '/uploads/documents/';
			$fileTypes = array('pdf'); // Allowed file extensions
			$verifyToken = md5('oOlnb%unique_saltui#876ghWWzxa' . $this->request->data['timestamp']);				
				
			if (!empty($_FILES) && $this->request->data['token'] == $verifyToken) 
			{				
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
				$uploadDir  =  WWW_ROOT . $uploadDir;
				

				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				if(strpos($fileParts['filename'],'.'))
				{
					throw new RuntimeException('Found more than one extension.');
				}
				if (in_array(strtolower($fileParts['extension']), $fileTypes))
				{				
					try {
	   
						// Undefined | Multiple Files | $_FILES Corruption Attack
						// If this request falls under any of them, treat it invalid.
						if (
							!isset($_FILES['Filedata']['error']) ||
							is_array($_FILES['Filedata']['error'])
						) {
							throw new RuntimeException('Invalid parameters.');
						}

						// Check $_FILES['upfile']['error'] value.
						switch ($_FILES['Filedata']['error']) {
							case UPLOAD_ERR_OK:
								break;
							case UPLOAD_ERR_NO_FILE:
								throw new RuntimeException('No file sent.');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE:
								throw new RuntimeException('Exceeded filesize limit.');
							default:
								throw new RuntimeException('Unknown errors.');
						}

						// You should also check filesize here.
						if ($_FILES['Filedata']['size'] > 4000000) {
							throw new RuntimeException('Exceeded filesize limit.');
						}

						// DO NOT TRUST $_FILES['Filedata']['mime'] VALUE !!
						// Check MIME Type by yourself.
						$finfo = new finfo(FILEINFO_MIME_TYPE);
						if (false === $ext = array_search(
							$finfo->file($tempFile),
							array(
								'pdf' => 'application/pdf'	
							),
							true
						)) {
							throw new RuntimeException('Invalid file format.');
						}
	
						// You should name it uniquely.
						// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$NewFileName=sha1_file($tempFile).rand(1,100).'.'.$ext;
						$targetFile = $uploadDir.$NewFileName;
						if (!move_uploaded_file($tempFile,$targetFile)) 
						{
							throw new RuntimeException('Failed to move uploaded file.');
						}
						else
						{
							echo 'uploaded_ok_'.$NewFileName;
						}	

					} catch (RuntimeException $e) {

						echo $e->getMessage();

					}
				
				}
				else
				{
					echo 'Invalid file type.';
				}
			}	
		}
	}
	
	//Check exists doc pdf
	public function check_exists_doc_pdf()
	{
		
		$this->autoRender=false;
		
		$targetFolder = '/uploads/documents/'; // Relative to the root and should match the upload folder in the uploader script

		if (file_exists( WWW_ROOT . $targetFolder . '/' . $_POST['filename'])) {
			echo 1;
		} else {
			echo 0;
		}	
		die;
	}
	// Uploading Acrs
	public function upload_applicant_acrs()
	{
		$this->autoRender=false;
		if($this->request->is('post'))
		{
				
			$uploadDir = '/uploads/applicant_acrs/';
			$fileTypes = array('pdf'); // Allowed file extensions
			$verifyToken = md5('oOlnb%unique_saltui#876ghWWzxa' . $this->request->data['timestamp']);				
				
			if (!empty($_FILES) && $this->request->data['token'] == $verifyToken) 
			{				
				
				$tempFile   = $_FILES['Filedata']['tmp_name'];
				$uploadDir  =  WWW_ROOT . $uploadDir;
				

				// Validate the filetype
				$fileParts = pathinfo($_FILES['Filedata']['name']);
				if(strpos($fileParts['filename'],'.'))
				{
					throw new RuntimeException('Found more than one extension.');
				}
				if (in_array(strtolower($fileParts['extension']), $fileTypes))
				{				
					try {
	   
						// Undefined | Multiple Files | $_FILES Corruption Attack
						// If this request falls under any of them, treat it invalid.
						if (
							!isset($_FILES['Filedata']['error']) ||
							is_array($_FILES['Filedata']['error'])
						) {
							throw new RuntimeException('Invalid parameters.');
						}

						// Check $_FILES['upfile']['error'] value.
						switch ($_FILES['Filedata']['error']) {
							case UPLOAD_ERR_OK:
								break;
							case UPLOAD_ERR_NO_FILE:
								throw new RuntimeException('No file sent.');
							case UPLOAD_ERR_INI_SIZE:
							case UPLOAD_ERR_FORM_SIZE:
								throw new RuntimeException('Exceeded filesize limit.');
							default:
								throw new RuntimeException('Unknown errors.');
						}

						// You should also check filesize here.
						if ($_FILES['Filedata']['size'] > 4000000) {
							throw new RuntimeException('Exceeded filesize limit.');
						}

						// DO NOT TRUST $_FILES['Filedata']['mime'] VALUE !!
						// Check MIME Type by yourself.
						$finfo = new finfo(FILEINFO_MIME_TYPE);
						if (false === $ext = array_search(
							$finfo->file($tempFile),
							array(
								'pdf' => 'application/pdf'	
							),
							true
						)) {
							throw new RuntimeException('Invalid file format.');
						}
	
						// You should name it uniquely.
						// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
						// On this example, obtain safe unique name from its binary data.
						$NewFileName=sha1_file($tempFile).rand(1,100).'.'.$ext;
						$targetFile = $uploadDir.$NewFileName;
						if (!move_uploaded_file($tempFile,$targetFile)) 
						{
							throw new RuntimeException('Failed to move uploaded file.');
						}
						else
						{
							echo 'uploaded_ok_'.$NewFileName;
						}	

					} catch (RuntimeException $e) {

						echo $e->getMessage();

					}
				
				}
				else
				{
					echo 'Invalid file type.';
				}
			}	
		}
	}
	
	//Check exists
	public function check_exists_applicant_acrs()
	{
		
		$this->autoRender=false;
		
		$targetFolder = '/uploads/applicant_acrs/'; // Relative to the root and should match the upload folder in the uploader script

		if (file_exists( WWW_ROOT . $targetFolder . '/' . $_POST['filename'])) {
			echo 1;
		} else {
			echo 0;
		}	
		die;
	}
}	