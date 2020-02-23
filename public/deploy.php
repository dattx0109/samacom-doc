<?php
if(isset($_GET['branch']))  {
    $branch = $_GET['branch'];
}
$branch = 'us_63';
?>

<?php if ($branch) : ?>
    <?php
    $commands = array(
        'cd ..',
        'git stash',
        'git checkout ' . $branch,
        'git pull origin ' . $branch,
        'git status'
    );

    // Run the commands for output
    $output = '';
    foreach($commands AS $command){
        // Run it
        $tmp = shell_exec($command);
        // Output
        $output .= "<span style=\"color: #6BE234;\">\$</span> <spa  n style=\"color: #729FCF;\">{$command}\n</span>";
        $output .= htmlentities(trim($tmp)) . "\n";
    }
    ?>

    <!DOCTYPE HTML>
    <html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>GIT DEPLOYMENT SCRIPT</title>
    </head>
    <body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
    <pre>
     .  ____  .    ____________________________
     |/  \|   |                            |
    [| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git Deployment Script v0.1 |
     |___==___|  /              &copy; saf.com.vn 2019 |
                  |____________________________|

        <?php echo $output; ?>
    </pre>
    </body>
    </html>

<?php else : ?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body>
Deploy failed!
</body>

<?php endif; ?>
