<!DOCTYPE html>

<html>

<head>
  <title>Nasa Image & Video Library</title>
  <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
  <div class="wrapper">
    <h1>NASA Image & Video API Test</h1>
    <div id="searchBox">
      <form action="apiCallResults.php" method="GET">
        <input type="text" id="searchPara" name="searchPara" required>
        <input type="submit" value="Search">
        <br>
        <input type="radio" name="mediaType" value="image" /><label>Images</label>
        <input type="radio" name="mediaType" value="audio" /><label>Audio</label>
      </form>
      <p>This site uses the Nasa Image & Video API to call images and data. <a href="https://images.nasa.gov/docs/images.nasa.gov_api_docs.pdf">images.nasa.gov API Documentation</a></p>
      <p>By Jamie Wilde.</p>
      <br>
      <hr>
    </div>
  </div>
</body>


</html>