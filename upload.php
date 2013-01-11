<?php
$uploaddir = '/home/postgres/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
$name = $_POST['name'];

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
{   // echo "File is valid, and was successfully uploaded.\n";
}
else   {   echo "File size greater than 300kb!\n\n";   }

echo "'$name'\n";

$connection_string="host=localhost port=5432 user=postgres password=123 dbname=postgres";
$conn = pg_connect($connection_string) or die("Falló la conexión.");

$query = "insert into image values ('$name', lo_import('$uploadfile'), 'now')";
$result = pg_query($query);

if($result)
{
    echo "File is valid, and was successfully uploaded.\n";
    unlink($uploadfile);
}
else
{
    echo "Filename already exists. Use another filename. Enter all the values.";
    unlink($uploadfile);
}
pg_close($conn);
?>

<html>
<head><title>File Upload To Database</title></head>

<body>
<h3>Please Choose a File and click Submit</h3>

  <form enctype="multipart/form-data" action="image.php" method="POST">

  <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
  Name : <input type="text" name="name" size="25" length="25" value="">

  <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
   File: <input name="userfile" type="file" size="25"/>

  <input type="submit" value="Upload" />
</form>

</body>
</html>