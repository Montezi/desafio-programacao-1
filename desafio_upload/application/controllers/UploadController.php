<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UploadController extends CI_Controller{

	function __construct(){
        parent::__construct();
		$this->load->model('VendaModel', 'venda', true);
		$this->load->model('User');
	}
	

    public function index(){
		//redirect to profile page if user already logged in
		if($this->session->userdata('loggedIn') == true){
			redirect('UploadController/main/');
		}
		
		if(isset($_GET['code'])){
			//authenticate user
			$this->google->getAuthenticate();
			
			//get user info from google
			$gpInfo = $this->google->getUserInfo();
			
            //preparing data for database insertion
			$userData['oauth_provider'] = 'google';
			$userData['oauth_uid'] 		= $gpInfo['id'];
            $userData['first_name'] 	= $gpInfo['given_name'];
            $userData['last_name'] 		= $gpInfo['family_name'];
            $userData['email'] 			= $gpInfo['email'];
			$userData['gender'] 		= !empty($gpInfo['gender'])?$gpInfo['gender']:'';
			$userData['locale'] 		= !empty($gpInfo['locale'])?$gpInfo['locale']:'';
            $userData['profile_url'] 	= !empty($gpInfo['link'])?$gpInfo['link']:'';
            $userData['picture_url'] 	= !empty($gpInfo['picture'])?$gpInfo['picture']:'';
			
			//insert or update user data to the database
            $userID = $this->User->checkUser($userData);
			
			//store status & user info in session
			$this->session->set_userdata('loggedIn', true);
			$this->session->set_userdata('userData', $userData);
			
			//redirect to profile page
			redirect('UploadController/main/');
		} 
		
		//google login url
		$data['loginURL'] = $this->google->loginURL();
		
		//load google login view
		$this->load->view('user_authentication/index',$data);
    }
	
/* 	public function profile(){
		//redirect to login page if user not logged in
		if(!$this->session->userdata('loggedIn')){
			redirect('/user_authentication/');
		}
		
		//get user info from session
		$data['userData'] = $this->session->userdata('userData');
		
		//load user profile view
		$this->load->view('upload',$data);
	} */
	
	public function logout(){
		
		//delete login status & user info from session
		$this->session->unset_userdata('loggedIn');
		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
		
		//redirect to login page
		redirect('UploadController/index');
    }

    	
	public function main(){

		if(!$this->session->userdata('loggedIn')){
			redirect('/user_authentication/');	}
		
		
		$data['userData'] = $this->session->userdata('userData');

       $this->load->view('upload',$data);
      

    }
    
  

  public function upload(){
  
	        $folder = random_string('alpha');
	        // definimos o path onde o arquivo será gravado
	        $path = "./uploads/".$folder;
	 
	       
	        if ( ! is_dir($path)) {
	       	
	        mkdir($path, 0777, $recursive = true);
	        
	        }
	 
	        
	        $configUpload['upload_path']   = $path;
	        
	        $configUpload['allowed_types'] = 'tab|txt';
	        
	        $configUpload['encrypt_name']  = TRUE;
	 
	        // passamos as configurações para a library upload
	        $this->upload->initialize($configUpload);
	 
	        // verificamos se o upload foi processado com sucesso
	        if ( ! $this->upload->do_upload('arquivo'))
	        {
	          
	         
	            $data= array('error' => $this->upload->display_errors());
	            $this->load->view('upload',$data);
	        }
	        else
	        {
	            
	            $data['dadosArquivo'] = $this->upload->data();


	            $arquivo = fopen ($data['dadosArquivo']['full_path'], 'r');
	           // $arquivo = file($data['dadosArquivo']['full_path'],FILE_SKIP_EMPTY_LINES);

				if($arquivo){
	    		// Lê o conteúdo do arquivo
	   			 $cabecalho = fgets($arquivo, 1024);
	   			 //echo $cabecalho.'<br />';
	   			$flag =0;	   			
	   			$bruto =0;
	    		while(!feof($arquivo))
	    		{
	        	//Mostra uma linha do arquivo
	    			
		       		 $linha = fgets($arquivo, 1024);
		       		 $linha = trim($linha);
		       		 $itens = explode( chr( 9 ), $linha ); 

		       		  if (isset($itens[1])) {

                         $purchaser_name =$itens[0];
		       		     $item_description = $itens[1];
		       		     $item_price = $itens[2];
		       		     $purchase_count =$itens[3];
		       		     $merchant_adress = $itens[4];
		       		     $merchant_name =$itens[5];
		       		     $total_linha = $item_price * $purchase_count;
		       		     
		       		     $bruto = $bruto +$total_linha;
		       		    
		       		    
		       		    $this->venda->setPurchaserName($purchaser_name);
		            	$this->venda->setItemDescription($item_description);
		           		$this->venda->setItemPrice($item_price);
		                $this->venda->setPurchaseCount($purchase_count);
		                $this->venda->setMerchantAdress($merchant_adress);
		                $this->venda->setMerchantName($merchant_name);

		                

		             try {               
		                    
		                    $this->venda->salvar();                           
		                                        
		                    $flag = 1;
		                    
		                           
		            } catch (Exception $e) {
		                $this->session->set_flashdata('msgErro', 'Houve algum erro durante a tentativa de upload! <br /> Erro:' . $e->getMessage());
		                redirect('/UplodController/main', 'location');
		            }   

                    
			       		             	
		       		 }               
                    

		       		
	       		 
	    		}
                 
	    		if ($flag ==1 ){
	    			 $this->session->set_flashdata('msgSucesso', 'Dados Cadastrados com Sucesso!'); 
	    			// redirect('', 'location'); 
					 $data = array('bruto' => $bruto);
					 $data['userData'] = $this->session->userdata('userData');
	    			 $this->load->view('upload',$data);

	    		}
	  			  // Fecha arquivo aberto
	   			 fclose($arquivo);
			            
	        }
	    }

	}




}
