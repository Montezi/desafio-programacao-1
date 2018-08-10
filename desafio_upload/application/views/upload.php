<html>
<head>
<link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.min.css"); ?>" />	
<title> Desafio Upload </title>
</head>
<body>
<div class="content">
<nav class="navbar navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Desafio</a>
</nav>
<?php if(isset($error)):?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p>Mensagem: </p>
        <?= $error ?>
    </div>
        
<?php endif; ?>
<?php
if ($this->session->flashdata('msgSucesso')) {
    ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	  <span aria-hidden="true">×</span>
 		</button>
        <p><b>Mensagem:</b></p>
        <?php
        echo $this->session->flashdata('msgSucesso');
        ?>
    </div>
    <?php
}

if ($this->session->flashdata('msgErro')) {
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p>Mensagem: </p>
        <?php
        echo $this->session->flashdata('msgErro');
        ?>
    </div>
    <?php
} 
?>

<br/>
<div class="content">
	<h2 class="text-center">Desafio Upload</h2>
	<div class="text-center">
	<?php echo "Bem Vindo <strong>".$userData['first_name']."</strong> (".$userData['email'].")"; ?>
	<a href="<?php echo site_url().'/UploadController/logout';?>" class="btn btn-danger" > Logout Google</a>
	</div>
	<p></p>
	<p></p>	
	<?php echo form_open_multipart('UploadController/upload');?>
	<div class="form-group">  	
		<div class ="col-md-8">
		    <label for="arquivo">Selecione o arquivo:</label> 
		    <input id="arquivo" name="arquivo" type="file" class="form-control here">
		</div>
	</div> 
	<div class="col-md-4">
		<div class="form-group">
			 <button name="submit" type="submit" class="btn btn-primary">Processar</button>
		</div>
	</div>

	</form>

	<?php if(isset($bruto)):?>
	<div class="alert alert-success" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">×</span>
			</button>
	    <p><b>Receita Brutal:</b></p>
	    <?php
	     echo 'R$'.$bruto;
	    ?>
	</div>
	    
	<?php endif; ?>
</div>

</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-3.3.1.slim.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/popper.min.js"); ?>"></script>
</html>
