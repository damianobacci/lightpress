<?php
require_once 'lib/common.php';
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
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'templates/title.php' ?>
        <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)): ?>
            <h2>
                <?php echo htmlspecialchars($row['title'], ENT_HTML5, 'UTF-8') ?>
            </h2>
            <div>
                <?php echo $row['created_at'] ?>
            </div>
            <p>
                <?php echo htmlspecialchars($row['body'], ENT_HTML5, 'UTF-8') ?>
            </p>
            <p>
                <a
                    href="view-post.php?post_id=<?php echo $row['id'] ?>"
                >Read more...</a>
            </p>
        <?php endwhile ?>
    </body>
</html>