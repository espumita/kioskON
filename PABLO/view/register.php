
<form action="register.php" method="POST">
    <table>
        
        <tr>
            <td>Username</td>
            <td>
                <input type="text" name="username" value="<?php if( isset($_POST['username']) )echo $_POST['username']; ?>" required>
            </td>
        </tr>
        
        <tr>
            <td>Email</td>
            <td>
                <input type="email" name="email" value="<?php if( isset($_POST['email']) )echo $_POST['email']; ?>" required>
            </td>
        </tr>
        
        <tr>
            <td>Password</td>
            <td>
                <input type="password" name="password" value="" required>
            </td>
        </tr>
        
        <tr>
            <td>Re-password</td>
            <td>
                <input type="password" name="re-password" value="" required>
            </td>
        </tr>
        
        
        <tr>
            <td>User type</td>
            <td>
                <input type="radio" name="type" value="normal" checked> Normal
                <input type="radio" name="type" value="editor"> Editor
            </td>
        </tr>
        
        <tr>
            <td colspan="2">
                <input type="submit" value="Register" name="register">
            </td>
        </tr>
        
    </table>
</form>
