<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome to <?php echo $title; ?></title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/styles.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
  <!-- HEADER: MENU + HERO SECTION -->
  <header class="p-3 text-center bg-light">
    <h1>
      <a href="/" class="text-dark text-decoration-none h5"><?php echo $title; ?></a>
    </h1>
    <a href="/addresses">My saved addresses</a>
  </header>