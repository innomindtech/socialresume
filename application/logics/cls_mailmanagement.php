<?php

class Mailmanagement {

	/*
	 * Function to send mail to the users who request for price drop information
	 */
    public static function sendpricedownmail($prodid) 	{

		// select the useremail who request for pricedown
		$db = new Db();
        $objItemData                	= new stdClass();
		$objItemData->table         	= 'pricedropinfo AS P';
        $objItemData->key           	= 'pd_id';
        $objItemData->fields	    	= 'P.pd_id,U.u_email,U.u_username';
		$objItemData->join				= 'LEFT JOIN tbl_user AS U ON U.u_id = P.user_id  ';
		$objItemData->where				= 'P.pr_id='.$prodid;
        $objItemData->itemperpage   	= '100';
        $objItemData->page	    		= '1';		// by default its 1
        $objItemData->debug	    		= true;
        $itemlist                    	= $db->getData($objItemData);
		
		// get the product details
		$prodInfo = Product::getProductInfo($prodid);
		// echopre($prodInfo);
		if(sizeof($itemlist->records) > 0 ) {
		 
			foreach($itemlist->records as $requsers ) {
				$emailAddress[$requsers->u_email] 	= $requsers->u_username;
				
				$replaceParameters['NAME'] 			= ucfirst($requsers->u_username);
				$replaceParameters['ITEMNAME'] 		= '<a href="'.BASE_URL.'product/'.$prodInfo->pr_id.'">'.$prodInfo->pr_title.'</a>';
				$replaceParameters['NEWPRICE'] 		= DEFAULT_CURRENCY.$prodInfo->pr_prize;
				$replaceParameters['PRODIMAGE'] 		= '<img src="'.returnimagepath('list_'.$prodInfo->pr_image,'list').'" width="134" height="201" alt="">';
				$replaceParameters['SHOW_MAIL'] 	= '';
				$replaceParameters['PRODPATH'] 		= BASE_URL.'product/'.$prodInfo->pr_id;
				// send login details to user
				$objMailer 		= new Mailer();
				//TODO
				$mailres = $objMailer->sendMail($emailAddress, 'pricedrop', $replaceParameters); 
				//echo $mailres;
			}
		
		}
		
		//exit();
		
		
		
       /// echo "send mail to users";
		//exit();
    }

	
	
	/*
	 *	function to send the rating mail to the purchased users
	 */
	public static function sendRatingMail() {
	
	
		// find the user list
		// $lastday = date('m-d-Y', strtotime('-7 days'));	 
		$lastday = date('m-d-Y', strtotime('-1 hours'));	 
		$db = new Db();
        $objItemData                	= new stdClass();
		$objItemData->table         	= 'transactions AS T';
        $objItemData->key           	= 'tr_id';
        $objItemData->fields	    	= 'T.tr_id,T.userid,T.prod_id,U.u_username,U.u_email,T.pr_addedby';
		$objItemData->join				= 'LEFT JOIN tbl_user AS U ON U.u_id = T.userid  ';
		$objItemData->where				= " DATE_FORMAT(tr_date, '%m-%d-%Y') = '".$lastday."'";
        $objItemData->itemperpage   	= '100';
        $objItemData->page	    		= '1';		// by default its 1
        $objItemData->debug	    		= true;
        $itemlist                    	= $db->getData($objItemData);
		
		// echopre1($itemlist);
		if(sizeof($itemlist->records) > 0 ) {
		 
			foreach($itemlist->records as $requsers ) {
				//echopre($requsers);
				// get seller info
				
				/* for validation key generate and insert to validation key table*/
				$validationKey	=	Util::randomCode();
				
				$data['vl_key']		= $validationKey;					
				$data['vl_raterid']	= $requsers->userid;					
				$data['vl_pdtid']	= $requsers->prod_id;	
				$data['vl_rating_for']	= $requsers->pr_addedby;	
					
				Notifications::addValidationKey($data);
				$emailAddress = '';
				/* end*/
				$sellerInfo = User::getUserField($requsers->pr_addedby,'u_username');
				$emailAddress[$requsers->u_email] 	= $requsers->u_username;
				//$emailAddress['vivek.k@innomindtech.in'] 	= $requsers->u_username;
				
				$replaceParameters['NAME'] 			= ucfirst($requsers->u_username);
				$replaceParameters['LINK'] 			= '<a href="'.BASE_URL.'feedback/'.$validationKey.'">Click Here</a>';
				$replaceParameters['SELLERNAME'] 	= $sellerInfo;
			   
				$replaceParameters['SHOW_MAIL'] 	= 1;
				// send rating details to user
				$objMailer 		= new Mailer();
				$mailres = $objMailer->sendMail($emailAddress, 'rating', $replaceParameters); 
				echo $mailres;
			}
		}
	}
    
	
	
	
	/*
	 *	function to send the offer accept email to users
	 */
	public static function sendOfferMail($offerid){
		if($offerid != '') {
			// get the offer details
			$offerDet = Notifications::getOfferDetails($offerid);
			
			$prodOwner = $offerDet->pr_addedby;
			
			$prodBuyer = ($offerDet->ofr_from_userid == $prodOwner)?$offerDet->ofr_to_userid:$offerDet->ofr_from_userid;
			
			//echo $prodOwner.':'.$prodBuyer;
			// get poster details
			$poster = User::getUserInfo($prodOwner);
			$posterName = $poster->u_username;
			$prodName =$offerDet->pr_title;
			//echopre($offerDet);
			
			// get the buyer informations
			$buyer = User::getUserInfo($prodBuyer);
			$buyerName = $buyer->u_username;
			//echopre($buyer);
			
			
			
			// send mail to buyer
			$replaceParameters['SHOW_MAIL'] 	= 1;
			$replaceParameters['NAME'] 			= ucfirst( $buyer->u_username);
			$replaceParameters['SELLER_NAME'] 	= "'".ucfirst( $posterName)."'";
			$replaceParameters['PRODNAME'] 		= "'".$prodName."'";
			$emailAddress[$buyer->u_email] 		= $buyer->u_username;
			$objMailer 		= new Mailer();
			$mailres = $objMailer->sendMail($emailAddress, 'offer-accpet', $replaceParameters); 
				
			// send mail to poster
			$replaceParameters['SHOW_MAIL'] 	= 1;
			$replaceParameters['NAME'] 			= ucfirst( $poster->u_username);
			$replaceParameters['SELLER_NAME'] 	= "'".ucfirst( $buyerName)."'";
			$replaceParameters['PRODNAME'] 		= "'".$prodName."'";
			$emailAddress1[$poster->u_email] 	= $poster->u_username;
			$objMailer 		= new Mailer();
			$mailres = $objMailer->sendMail($emailAddress1, 'offer-accpet-poster', $replaceParameters); 
			
			
			
			//echopre($poster);
		}
		
	}
	
	

}

?>
