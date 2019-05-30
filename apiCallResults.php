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
      
    <?php
      //If the user doesn't select image/audio, a PHP error is reported. This disables error reporting.
      error_reporting(0);
      
      //Declare and load local variables with passed form data, Nasa API and search parameter 
      $searchPara=$_GET["searchPara"];
      $searchMediaTypePara=$_GET["mediaType"];
      $apiKey = "QtEYRWiyWHbtNl6dZ9CeGKozJTPPPEjZE71ZGj6v";
      $url = "https://images-api.nasa.gov/search?q=".$searchPara."&media_type=".$searchMediaTypePara;
      
      // Decode json contents
      $result = file_get_contents($url);
      $dataDecoded = json_decode($result, true);
      
      // Count amount of returned records 
      $countArrayIndex = (count($dataDecoded["collection"]["items"]));
    
      if ($searchMediaTypePara == "image")
      {
        $i = 0;
        while( $i < $countArrayIndex) 
        {
          // Traverse the decoded JSON object which is now a muldimensional associative array. Load the image and asset ID of every record in the loop.
          $imgHref = $dataDecoded["collection"]["items"][$i]["links"][0]["href"];
          $nasaAssetId = $dataDecoded["collection"]["items"][$i]["data"][0]["nasa_id"];
          echo '<form action="assetPage.php" method="GET">';
          echo '<input type="hidden" id="nasaAssetId" name="nasaAssetId" value="'.$nasaAssetId.'">';
          echo '<div id="imgBox"><input type="image" src="'.$imgHref.'" height="300px" width="300px" alt="asset"></form></div>';         
          $i++;
        }
      }
    
      if ($searchMediaTypePara == "audio")
      {
        $countArrayIndex = (count($dataDecoded["collection"]["items"]));
        $i = 0;
        while(( $i < $countArrayIndex) and ($i < 10))
        {
          $assetJson = $dataDecoded["collection"]["items"][$i]["href"];
          $assetTitle = $dataDecoded["collection"]["items"][$i]["data"][0]["title"];
          $mp3Href = str_replace(' ', '%20', $assetJson);
          $result2 = file_get_contents($mp3Href);
          $dataDecoded2 = json_decode($result2, true);
          $mp3Href = $dataDecoded2[0];
          echo $assetTitle;
          echo '<br>';
          echo '<audio controls><source src="'.$mp3Href.'" type="audio/wav"><source src="'.$mp3Href.'" type="audio/mpeg"></audio>';
          echo '<br><br>';
          $i++;
        }
      }
      
      if (!isset ($searchMediaTypePara)){
        echo '<center><strong>You must select a media type.</center></strong>';
      }
     ?>
    </div>
  </body>
</html>