<?php
	include 'connection.php';	
?>

<?php
    // check if a file was submitted
    if(!isset($_FILES['userfile'])) {
        echo '<p>Please select a file</p>';
    }
    else
        {
        try {		
            upload();
            // give praise and thanks to the php gods
            echo '<p>Thank you for submitting</p>';
        }
        catch(Exception $e) {
            echo $e->getMessage();
            echo 'Sorry, could not upload file';
        }
    }
?>

<?php
    // the upload function
    function upload()
	{
 
		if(is_uploaded_file($_FILES['userfile']['tmp_name'])) 
		{

			// check the file is less than the maximum file size
			// prepare the image for insertion
			$imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));			
			// $imgData = addslashes($_FILES['userfile']);

			// get the image info..
			$size = getimagesize($_FILES['userfile']['tmp_name']);			

			// put the image in the db...
			// database connection
			

			// our sql query
			//$sql = "INSERT INTO testblob ( image_id , image_type ,image, image_size, image_name) VALUES ('', '{$size['mime']}', '{$imgData}', '{$size[3]}', '{$_FILES['userfile']['name']}')";
			pg_exec("INSERT INTO imagen(nombre,archivo) VALUES('".$_FILES['userfile']['name']."','".$imgData."')");
			// insert the image
					
		}
    
    }
?>

<?php
function grabar()
{
	if (isset($_GET['grabar']))
	{		
		?>
			hola
		<?php
		$fp = fopen($_POST["pagina"].".php","w");
		fwrite($fp, "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>" .PHP_EOL."<html>".PHP_EOL."<head>".PHP_EOL."</head>".PHP_EOL."<body>".PHP_EOL."<center>".PHP_EOL);	//lineas iniciales de la nueva pagina php
		
		//agrega el encabezado
		fwrite($fp,$_POST['encabezado']."</br></br>".PHP_EOL);
	
		//agregar foto
		echo $_POST_FILES['img']['name'];		
		//$tmpName  = $_POST['img'];
		//echo $tmpName;  
		//$img = imagecreatefromjpeg($_FILES['img']);
		//echo $img;
		//$data = file_get_contents($_FILES['img']);
		//echo $data;
		//echo $_POST['img'];
		$data  = file_get_contents('http://animalesdelmundo.files.wordpress.com/2010/06/il_pinguino_angela.jpg');
		//$data  = file_get_contents('C:\Users\Public\Pictures\Sample Pictures/Desert.jpg');
		echo $data['size'];
		
		
		//echo $data;
		
		
		$directorio = '/images/';
		
		//move_uploaded_file($_POST_FILES['img']['tmp_name'],$directorio.$nombre;
		

		//funcion texto
		fwrite($fp,'<div class="divspoiler">.'.PHP_EOL.'<input type="button" value="Texto"'."style='width:320px;' onclick=".'"if (this.parentNode.nextSibling.childNodes[0].style.display != '."'') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Texto'; }".'" />'.PHP_EOL);//agregar nombre boton texto
		fwrite($fp,'</div><div><div class="spoiler" style="display: none;">'.PHP_EOL);
		fwrite($fp,$_POST['descripcion'].PHP_EOL.'</div></div>');	//Fin del boton texto
		
		//funcion galeria
		
		//funcion galeria + texto
		
		//funcion contacto
		if (strlen($_POST['celular']) == 0 && strlen($_POST['correo']) == 0 && strlen($_POST['direccion']) == 0)
		{}
		else
		{		
			fwrite($fp,'<div class="divspoiler">.'.PHP_EOL.'<input type="button" value="Contacto"'."style='width:320px;' onclick=".'"if (this.parentNode.nextSibling.childNodes[0].style.display != '."'') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Contacto'; }".'" />'.PHP_EOL);
			fwrite($fp,'</div><div><div class="spoiler" style="display: none;">'.PHP_EOL);		
			if (strlen($_POST['celular']) > 0)
			//fwrite($fp,'<form>'.PHP_EOL.'<input type="button" onclick="href=tel:+56'.$_POST['celular'].'" value="Llamar"/>'.PHP_EOL.'</form>');
			fwrite($fp,'<a href="tel:+56'.$_POST['celular'].'">Llamar</a></br>');
			if (strlen($_POST['correo']) > 0)
			//fwrite($fp,'<form>'.PHP_EOL.'<input type="button" onclick="href=mailto:'.$_POST['correo'].'" value="Correo"/>'.PHP_EOL.'</form>');
			fwrite($fp,'<a href="mailto:'.$_POST['correo'].'">Correo</a></br>');		
			if (strlen($_POST['direccion']) >0)
			fwrite($fp,'<a href="'.$_POST['direccion'].'">Direccion</a></br>');
			//fwrite($fp,'<form>'.PHP_EOL.'<input type="button" onclick="href='.$_POST['direccion'].'value="Correo"/>'.PHP_EOL.'</form>');				
			fwrite($fp,'</div></div>');	//Fin del boton contacto
		}
		
		//funcion redes sociales
		fwrite($fp,'<div class="divspoiler">.'.PHP_EOL.'<input type="button" value="Redes Sociales"'."style='width:320px;' onclick=".'"if (this.parentNode.nextSibling.childNodes[0].style.display != '."'') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Redes Sociales'; }".'" />'.PHP_EOL);
		fwrite($fp,'</div><div><div class="spoiler" style="display: none;">'.PHP_EOL);		
		if (strlen($_POST['face']) >0)
		fwrite($fp,'<a href="'.$_POST['face'].'">Facebook</a></br>');
		if (strlen($_POST['twit']) >0)
		fwrite($fp,'<a href="'.$_POST['twit'].'">Twitter</a></br>');
		
		fwrite($fp,'</div></div>');	//Fin del boton redes sociales
		
		fwrite($fp,PHP_EOL."</center>".PHP_EOL."</body>".PHP_EOL."</html>");
		fclose($fp);
			
	}
}		
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/ajaxupload.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){

		var thumb = $('img#thumb');	

		new AjaxUpload('imageUpload', {
			action: $('form#newHotnessForm').attr('action'),
			name: 'image',
			onSubmit: function(file, extension) {
				$('div.preview').addClass('loading');
			},
			onComplete: function(file, response) {
				thumb.load(function(){
					$('div.preview').removeClass('loading');
					thumb.unbind();
				});
				thumb.attr('src', response);
			}
		});
	});
</script>	

</head>
<body>
<center>
<table border="1">
<tr>
<td width="150">
<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
            <input name="userfile[]" type="file" accept="image/*" />
            <input type="submit" value="Submit" />
        </form>

</td>
<td width="400">
Chao 
</td>
<td width="320">
<center>
<form id="crear" action="index.php?grabar" method="post" style="margin:0px;">
<input type="text" style="WIDTH: 320px;" name="encabezado" placeholder="Ingrese Encabezado"/></br></br>


</br></br>

<div class="divspoiler">
<input type="button" value="Texto" style='width:320px;' onclick="if (this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Texto'; }" />
</div><div><div class="spoiler" style="display: none;">
<textarea placeholder="Escribe aquí el comentario..." name="descripcion" cols="37" rows="5"></textarea>
</div></div>


<div class="divspoiler">
<input type="button" value="Galeria" style='width:320px;' onclick="if (this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Galeria'; }" />
</div><div><div class="spoiler" style="display: none;">
<input type=file accept="image/*" name="img1" style="WIDTH: 320px;">
<input type=file accept="image/*" name="img2" style="WIDTH: 320px;">
<input type=file accept="image/*" name="img3" style="WIDTH: 320px;">
</div></div>

<div class="divspoiler">
<input type="button" value="Galeria + Texto" style='width:320px;' onclick="if (this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Galeria + Texto'; }" />
</div><div><div class="spoiler" style="display: none;">
<input type=file accept="image/*" name="img4" style="WIDTH: 320px;">
<textarea placeholder="Escribe aquí el comentario..." name="t1" cols="37" rows="5"></textarea>
<input type=file accept="image/*" name="img5" style="WIDTH: 320px;">
<textarea placeholder="Escribe aquí el comentario..." name="t2" cols="37" rows="5"></textarea>
<input type=file accept="image/*" name="img6" style="WIDTH: 320px;">
<textarea placeholder="Escribe aquí el comentario..." name="t3" cols="37" rows="5"></textarea>
</div></div>

<div class="divspoiler">
<input type="button" value="Contacto" style='width:320px;' onclick="if (this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Contacto'; }" />
</div><div><div class="spoiler" style="display: none;">
<input type="text" name="celular" placeholder="Ingrese numero Celular"/></br>
<input type="text" name="correo" placeholder="Ingrese e-mail"/><br>
<input type="text" name="direccion" placeholder="Ingrese link google maps"/><br>
</div></div>

<div class="divspoiler">
<input type="button" value="Redes Sociales" style='width:320px;' onclick="if (this.parentNode.nextSibling.childNodes[0].style.display != '') { this.parentNode.nextSibling.childNodes[0].style.display = ''; this.value = 'Ocultar'; } else { this.parentNode.nextSibling.childNodes[0].style.display = 'none'; this.value = 'Redes Sociales'; }" />
</div><div><div class="spoiler" style="display: none;">
<input type="text" name="face" placeholder="Ingrese su Facebook"/></br>
<input type="text" name="twit" placeholder="Ingrese su Twitter"/></br>
</div></div>

</br>
</center>
</td>
</tr>
<tr>
<td></td>
<td>
	<?php	
		grabar();					
	?>
</td>
<td>	
		</br>
		Nombre de la Pagina: <input type="text" name="pagina" size="20" maxlength="15"/></br>
		<input type="submit" value="Crear Pagina" style='width:320px;' /></br>
		</br>
</td>
</tr>
</table>
</form>			
</center>
	
</body>

</html>