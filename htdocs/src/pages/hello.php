<?php
$name = $request->get('name', 'world');
?>

<h1>Hello <?php echo htmlspecialchars($name, ENT_QUOTES) ?></h1>
