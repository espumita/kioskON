<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
        .error {
            color: #FF0000;
        }
        </style>
    </head>
    <body>

        <?php
        $dbConnection = new DataBaseConnection();
        $dbConnection->start();
        $connection=$dbConnection->connection();
        
        // define variables and set to empty values
        $issueNumberErr = $costErr = $fileErr = "";
        $issueNumber = $cost = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["number"])) {
                $issueNumberErr = "Se requiere el número de la publicación";
            }elseif (is_numeric ($_POST["number"])) {
                $name = test_input($_POST["number"]);
            }else{
                $issueNumberErr = "Introduzca un valor numérico";
            }
            
            if (empty($_POST["cost"])) {
                $costErr = "Se requiere el coste de la publicación";
            } elseif(is_numeric ($_POST["cost"])) {
                $email = test_input($_POST["cost"]);
            }else{
                $costErr = "Introduzca un valor numérico";
            }

            if (empty($_FILES['userfile']['size'])) {
                $fileErr = "Se requiere que suba un documento";
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <table>
                <tr>
                    <td><input name="userfile" type="file" id="userfile"></td>
                    <td><span class="error">* <?php echo $fileErr;?></span></td>
                </tr>
            </table>
            <table>
                <tr> 
                    <td> Revista: </td>
                    <td>
                        <select name="magazines">
                            <?php
                            $results = getMagazines($connection);
                            while ($row = mysqli_fetch_row($results)) {
                                echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Número: </td>
                    <td><input name="number" type="text" id="number">
                        <span class="error">* <?php echo $issueNumberErr;?></span>
                    </td>
                </tr>
                <tr>
                    <td>Coste: </td>
                    <td><input name="cost" type="text" id="cost">
                        <span class="error">* <?php echo $costErr;?></span>
                    </td>
                </tr>
                <tr>
                    <td><input name="upload" type="submit" class="box" id="upload" value=" Subir "></td>
                </tr>
            </table>
        </form>


        <?php
        /*
         *
          CREATE TABLE issues (
          id INT NOT NULL AUTO_INCREMENT,
          fileName VARCHAR(30) NOT NULL,
          magazinesId INT NOT NULL,
          issueNumber INT NOT NULL,
          fileSize INT NOT NULL,
          publicationDate DATE NOT NULL,
          fileContent MEDIUMBLOB NOT NULL,
          unitCost INT NOT NULL,
          PRIMARY KEY(id)
          );
         * 	
         */


        subir($connection);

        function conectar() {

            $host = "localhost";
            $password = "";
            $user = "root";
            $database = "test";

            $connection = mysqli_connect($host, $user, $password, $database);

            if (mysqli_connect_errno()) {
                printf("Falló la conexión: %s\n", mysqli_connect_error());
                exit();
            }

            return $connection;
        }

        function subir($connection) {
            define('MB', 1048576);
            $maxSize = 1 * MB;
            if (isset($_POST['upload']) && ($size = $_FILES['userfile']['size']) > 0) {
                $allowedExtensions = array('pdf');
                $fileName = $_FILES['userfile']['name'];
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowedExtensions)) {
                    echo "Error: la extensión .$ext no está permitida, suba archvios tipo ";
                    $string = implode(", ", $allowedExtensions);
                    echo $string . ".";
                    exit();
                }
                if ($size > $maxSize) {
                    echo "Fichero demasiado grande, tamaño máximo de " . $maxSize / 1048576 . "MB";
                    exit();
                }

                $tmpName = $_FILES['userfile']['tmp_name'];
                $fileSize = $_FILES['userfile']['size'];
                $fileType = $_FILES['userfile']['type'];
                $magazinesId = $_POST['magazines'];
                $issueNumber = $_POST["number"];
                $unitCost = $_POST["cost"];
                $publicationDate = date("Y-m-d H:i:s");

                $fp = fopen($tmpName, 'r');
                $fileContent = fread($fp, filesize($tmpName));
                $fileContent = addslashes($fileContent);
                fclose($fp);

                if (!get_magic_quotes_gpc()) {
                    $fileName = addslashes($fileName);
                }

                $query = "INSERT INTO issues (fileName, magazinesId, issueNumber, fileSize, publicationDate, fileContent, unitCost ) " .
                        "VALUES ('$fileName', $magazinesId, $issueNumber, $fileSize, '$publicationDate', '$fileContent', $unitCost)";

                $resultado = mysqli_query($connection, $query) or die("ERROR");

                echo "<br>Archivo $fileName subido correctamente<br>";
            }
        }

        function getMagazines($connection) {
            $query = "SELECT * FROM magazines WHERE editorial='L Editorial'";
            $resultado = mysqli_query($connection, $query);
            return $resultado;
        }
        ?>
    </body>
</html>