<?php
//echo date('l', strtotime('2018-10-16'));
?>

<?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php if(isset($js_files)){ foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; }?>
<?php echo $output; ?>


