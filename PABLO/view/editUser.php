
<form action="editUser.php" method="POST">
    <table>
        
        <tr>
            <td>Username</td>
            <td>
                <input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; else echo $this->data['username']; ?>" required>
            </td>
        </tr>
        
        <tr>
            <td>Email</td>
            <td>
                <input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo $this->data['email']; ?>" required>
            </td>
        </tr>
        
        <tr>
            <td>Password</td>
            <td>
                <input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; else echo $this->data['password']; ?>" required>
            </td>
        </tr>
        
        <tr>
            <td>Re-password</td>
            <td>
                <input type="password" name="re-password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; else echo $this->data['password']; ?>" required>
            </td>
        </tr>
        
        <tr>
            <td colspan="2">
                <input type="submit" value="Edit" name="edit">
            </td>
        </tr>
        
    </table>
</form>
