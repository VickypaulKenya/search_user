
<?php
include_once "../include/header.php";
?>

<div class="form">
    <h2>Search user</h2>
    <form action="searchuser.php" method="post">
        <div class="input-field">
            <label for="search_user">Search user</label>
            <input type="text" id="search_user" placeholder="Search user" name="usersearch">
        </div>
        <button class="btn" type="submit">Submit</button>
    </form>
</div>

</body>
</html>