<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data" action="">
            <table width="350" border="0" cellpadding="1" cellspacing="1">
                <tr>
                    <td><input name="userfile" type="file" id="userfile"></td>
                    <td><input name="upload" type="submit" class="box" id="upload" value=" Subir "></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Título:</td>
                    <td><input name="title" type="text" id="title"></td>
                </tr>
                <tr>
                    <td>Editorial: </td>
                    <td><input name="editorial" type="text" id="editorial"></td>
                </tr>
            </table>
        </form>


        <?php
        /*
         * 
          CREATE TABLE magazines (
          id INT NOT NULL AUTO_INCREMENT,
          fileName VARCHAR(30) NOT NULL,
          title VARCHAR(30) NOT NULL,
          editorial VARCHAR(30) NOT NULL,
          size INT NOT NULL,
          publishedDate DATE NOT NULL, 
          content MEDIUMBLOB NOT NULL,
          PRIMARY KEY(id)
          );
         */
        $connection = conectar();
        subir($connection);

        function conectar() {
            
            $host = "localhost";
            $password="";
            $user = "root";
            $database = "test";
            /*
            $host = "mysql.hostinger.es";
            $password="kioskon";
            $user = "u982930690_kios";
            $database = "u982930690_kios";
             */
            
            $connection = mysqli_connect($host, $user, $password, $database);

            if (mysqli_connect_errno()) {
                printf("Falló la conexión: %s\n", mysqli_connect_error());
                exit();
            }

            return $connection;
        }

        function subir($connection) {
            define('MB', 1048576);
            if (isset($_POST['upload']) && ($size=$_FILES['userfile']['size']) > 0 ) {
                echo $size;
                if($size > 1*MB){
                    echo "Fichero demasiado grande";
                    exit();
                }
                $fileName = $_FILES['userfile']['name'];
                $tmpName = $_FILES['userfile']['tmp_name'];
                $fileSize = $_FILES['userfile']['size'];
                $fileType = $_FILES['userfile']['type'];
                $title = $_POST["title"];
                $editorial = $_POST["editorial"];
                $publishedDate = date("Y-m-d H:i:s");

                $fp = fopen($tmpName, 'r');
                $content = fread($fp, filesize($tmpName));
                $content = addslashes($content);
                fclose($fp);

                if (!get_magic_quotes_gpc()) {
                    $fileName = addslashes($fileName);
                }
                
                $query = "INSERT INTO magazines (fileName, title, editorial, size, publishedDate, content ) " .
                        "VALUES ('$fileName', '$title', '$editorial', '$fileSize', '$publishedDate', '$content')";

                $resultado = mysqli_query($connection, $query) or die("ERROR");

                echo "<br>File $fileName uploaded<br>";
            }
        }
        ?>
    </body>
</html>