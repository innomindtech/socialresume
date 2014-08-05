<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo isset($metaTitle)?(($metaTitle!='')?$metaTitle:META_TITLE):META_TITLE; ?></title>
<meta name="description" content="<?php echo isset($metaDes)?(($metaDes!='')?$metaDes:META_DES):META_DES; ?>" />
<meta name="keywords" content="<?php echo isset($metaKey)?(($metaKey!='')?$metaKey:META_KEYWORDS):META_KEYWORDS; ?>" />
 
<meta name="viewport" content="width=device-width, initial-scale=1">
 

  




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="<?php echo BASE_URL; ?>application/helpers/js/jquery.validate.js"></script>
	
		<script src="<?php echo BASE_URL; ?>application/helpers/js/validations.js"></script>
 
<script language="javascript">
var BASE_URL = "<?php echo BASE_URL;?>";
</script>
</head>
<body>
<!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
 
	 
	
	 <?php echo $content_for_layout;?>
	
	  

</body>
</html>
