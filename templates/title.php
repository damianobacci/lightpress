<div style="float: right;">
    <?php if (isLoggedIn()): ?>
    Hello <?php echo htmlEscape(getAuthUser()) ?>.
        <a href="logout.php">Log out</a>
    <?php else: ?>
        <a href="login.php">Log in</a>
    <?php endif ?>
</div>

<a href="index.php"><h1>Lightpress</h1></a>
<p>A simple CMS made in PHP.</p>