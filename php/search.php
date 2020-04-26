<?php
include("../model/db.php");
include("../class/result.php");


if (isset($_GET["term"])) {
    $term =  $_GET["term"];
} else {
    exit("you must enter a search term");
}


$type = isset($_GET["type"]) ? $_GET["type"] : "sites";
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

$term = $_GET["term"]
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.2">
    <link rel="stylesheet" href="../css/search.css?v=1.0">
    <title>Google Search</title>
</head>

<body>

    <div class="wrapper">

        <div class="header">
            <div class="headerContent">

                <div class="logoContainer">
                    <a href="../index.php">
                        <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" alt="google logo">
                    </a>
                </div>

                <div class="searchContainer">
                    <form action="search.php" method="GET">
                        <div class="searchBarContainer">
                            <input type="text" name="term" class="searchBoxvalue" value="<?php echo $_GET["term"]; ?>">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="tabs">

                <ul>
                    <li class='<?php echo $type == 'sites' ? 'active' : '' ?>'>
                        <a href='<?php echo "search.php?term=$term&type=sites" ?>'>Sites</a>
                    </li>
                    <li class='<?php echo $type == 'images' ? 'active' : '' ?>'>
                        <a href='<?php echo "search.php?term=$term&type=images" ?>'>Images</a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="mainResultsSection">
            <?php
            $resultProvider = new Result($con);
            $pageLimit = 20;
            $numResults = $resultProvider->getNumResults($term);

            echo "<p class='resultsCount'>$numResults results found</p>";

            echo $resultProvider->getResults($page, $pageLimit, $term);
            ?>
        </div>

    </div>



</body>

</html>