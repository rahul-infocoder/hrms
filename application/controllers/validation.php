<?php

 $configVali = array( 
     'saveCustomer' =>array(
               array(
                     'field'   => 'ename',
                     'label'   => 'Customer Name',
                     'rules'   => 'required'
                  ),
             
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required|valid_email'
                  ),
				 array(
                     'field'   => 'company',
                     'label'   => 'Company',
                     'rules'   => 'required'
                  ),
				   array(
                     'field'   => 'ccompany',
                     'label'   => 'Customer Company',
                     'rules'   => 'required'
                  ),
				   array(
                     'field'   => 'mobile',
                     'label'   => 'Mobile',
                     'rules'   => 'required'
                  ),
				   array(
                     'field'   => 'address',
                     'label'   => 'Address',
                     'rules'   => 'required'
                  ),
				   array(
                     'field'   => 'zip',
                     'label'   => 'Zip Code',
                     'rules'   => 'required'
                  )
				  
				  )
				  
				  );
				  
		
?>