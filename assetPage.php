<!DOCTYPE html>

<html>

  <head>
    <title>Nasa Image & Video Library</title>
    <link rel="stylesheet" type="text/css" href="main.css">
  </head>
    <body>
      <div class="wrapper">
        <?php
        $nasaAssetId=$_GET["nasaAssetId"];
        $apiKey = "QtEYRWiyWHbtNl6dZ9CeGKozJTPPPEjZE71ZGj6v";
        $url = "https://images-api.nasa.gov/search?q=.$nasaAssetId";

        $result = file_get_contents($url);
    
        // Decode json contents
        $dataDecoded = json_decode($result, true);
 
        // Traverse the decoded JSON object which is now a muldimensional associative array. Load the image, asset ID and description of the record.
        $imgHref = $dataDecoded["collection"]["items"][0]["links"][0]["href"];
        $nasaAssetTitle = $dataDecoded["collection"]["items"][0]["data"][0]["title"];
        $nasaAssetDesc = $dataDecoded["collection"]["items"][0]["data"][0]["description"];
    

        echo '<h1>'.$nasaAssetTitle.'</h1>';
        echo $nasaAssetDesc; 
        echo '<img src="'.$imgHref.' "height="" width="50%" alt="Image of '.$nasaAssetTitle.'"></img>'; 
        echo '/asset ID/ '.$nasaAssetId;

    ?>
    </div>
  </body>


</html>