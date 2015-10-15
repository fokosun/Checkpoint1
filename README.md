
# Checkpoint One
An agnostic package that conforms with thephpleague.com specifications and uses the Test Driven Development process (PHPUnit)

[![Build Status](https://travis-ci.org/andela-fokosun/Checkpoint1.svg)](https://travis-ci.org/andela-fokosun/Checkpoint1) [![Latest Stable Version](https://poser.pugx.org/florence/dictionary/v/stable)](https://packagist.org/packages/florence/dictionary) [![Total Downloads](https://poser.pugx.org/florence/dictionary/downloads)](https://packagist.org/packages/florence/dictionary) [![Latest Unstable Version](https://poser.pugx.org/florence/dictionary/v/unstable)](https://packagist.org/packages/florence/dictionary) [![License](https://poser.pugx.org/florence/dictionary/license)](https://packagist.org/packages/florence/dictionary)

## Classes
- Data: The main dictionary, a static associative array that contains urban words
- Dictionary: CRUD implementations and Ranking System Implementation.

## Testing
 Phpunit 5.0 was used for testing the classes.

## Usage

### Add Slang

### Remove Slang

### Update Slang

### Delete Slang



### Implement Ranking

```
$dictionary = Data::$data;

$ranker = new Dictionary($dictionary); 

```

You can now traverse through the array to get your desired output like so:

```
foreach(Data::$data as $row => $innerArray)
{
    echo("Sample-sentence: "."<br>".$innerArray['Sample-sentence'])."<br>";

    $res = $innerArray['Sample-sentence'];

    $getRank = $ranker->rankWords($res);

    $output = '';

        foreach($getRank as $key => $value)
        {
            $output .= "$key => $value".', ';
        }

        $output = rtrim("Output: "."<br>".$output,',')."<br>";

        // print the final output

        echo $output;
        echo "<br>";
    }
```

Sample Output:
```
[“Tight” => 3, “Prosper” => 2, “Yes” => 1, “Have” => 1, “you” => 1, “finished” => 1, “the” => 1, “curriculum?” => 1]

```



## Contributing
Please check out [CONTRIBUTING](CONTRIBUTING.md) file for detailed contribution guidelines.


## License
See the bundled [LICENSE](LICENSE.md) file for more details.