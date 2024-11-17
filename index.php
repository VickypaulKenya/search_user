
<?php
include_once("include/header.php");
?>

<div class="form">
    <h2>Sign Up</h2>
    <form action="include/handle_form.inc.php" method="post">
        <div class="input-field">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Username" name="username">
        </div>
         <div class="input-field">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="email" name="email">
        </div>
         <div class="input-field">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="password" name="password">
        </div>
        <button class="btn" type="submit">Submit</button>
    </form>
</div>

</body>
</html>