<!DOCTYPE html>
<?php require('config.php'); ?>
<html>
<head>
  <title>Dashboard</title>
  <meta charset="UTF-8">
<style>
h1 {
  text-align: center;
  width: 100%;
}
#wrapper {
  width:100%;
}
.item {
  width:29%;
  float:left;
	 background-color: #cddff2;
  margin: 1%;
  padding: 1%;
}
body {
  font-family: helvetica, arial, sans-serif;
  background-color: #DDD;
}

li {
	 width: 100%;
	 min-height: 2rem;
	 position: relative;
	 float: left;
  display: inline;
	 background-color: #EEE;
	 border-radius: 4px;
  margin-top: 4px;
}
li a {
  display: block;
  padding: 1%;
  margin: 1% 0 0 1%;
  text-decoration: none;
}
label {
  font-weight: bold;
}
.local {
  background-color: #eee;
}
.production {
  background-color: #666;
}
.local a {
  color: #666;
}
.production a {
   color: #eee;
}
</style>
<script src="https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js"></script>
</head>
<body>
<h1>Site Dashboard</h1>
<div id="wrapper grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 30%, "percentPosition": true }'>

<?php foreach ($sites as $sitename => $type): ?>
  <div class="item grid-item">
  <h2><?php echo $sitename; ?></h2>
  <ul>
  <?php foreach ($type as $typename => $urls): ?>
  <?php foreach ($urls as $url): ?>
  <?php
    $label = '';
    if (is_array($url)) {
      $key = key($url);
      if (!is_numeric($key)) {
        $label = '<label>' . $key . '</label>: ';
      }
      $url = array_pop($url);
    }
    $parts = parse_url($url);
    $text = $label . $parts['host'];
    if (!empty($parts['port'])) {
      $text .= ':' . $parts['port'];
    }
  ?>
    <li class="<?php echo $typename ?>"><a target="_blank" href="<?php echo $url; ?>"><?php echo $text ?></a></li>
  <?php endforeach; ?>
  <?php endforeach; ?>
  </ul>
  </div>
<?php endforeach; ?>

</div>
</body>
</html>