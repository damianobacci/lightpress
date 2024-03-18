<?php
require_once 'lib/common.php';
session_start();
$pdo = getPDO();
$statement = $pdo->query(
    'SELECT
        id, title, created_at, body
    FROM
        post
    ORDER BY
        created_at DESC'
);
if ($statement === false)
{
    throw new Exception('There was a problem running this query');
}

$notFound = isset($_GET['not-found']);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'templates/title.php' ?>
        <?php if ($notFound): ?>
            <div style="border: 1px solid #ff6666; padding: 6px;">
                Error: cannot find the requested blog post
            </div>
        <?php endif ?>
        <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)): ?>
            <h2>
               <a href="view-post.php?post_id=<?php echo $row['id'] ?>"><?php echo htmlEscape($row['title']) ?></a> 
            </h2>
            <div>
                <?php echo convertSqlDate($row['created_at']) ?>
                (<?php echo countCommentsForPost($row['id']) ?> comments)
            </div>
            <p>
                <?php echo htmlEscape($row['body']) ?>
            </p>
            <p>
                <a
                    href="view-post.php?post_id=<?php echo $row['id'] ?>"
                >Read more...</a>
            </p>
        <?php endwhile ?>
    </body>
</html>