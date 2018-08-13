[![Build Status](https://travis-ci.org/fokosun/Checkpoint1.svg?branch=master)](https://travis-ci.org/fokosun/Checkpoint1)

# Checkpoint One
This package was built mainly for academic purposes. It can be 
described ad an agnostic package that conforms with thephpleague.com 
specifications and uses the Test Driven Development process (PHPUnit)

## Classes
- Data: 
The main dictionary, a static associative array that contains urban words

- Dictionary: 
CRUD implementations and Ranking System Implementation.

- WordExistsException:
Returns the associated exception message

- WordNotFoundException:
Returns the associated exception message

## Installation

Require via composer like so:

```
    composer require florence/dictionary
```

## Usage

```
    $dictionary = Data::$data;

    $dictionary = new Dictionary($dictionary); 

```

### Add Slang

```
    $dictionary->addSlang($slang, $description, $sentence);
```

### Retrieve Slang

```
    $dictionary->findOne($slang);
    
    $dictionary->findAll();
```

### Update Slang

```
    $dictionary->updateSlang($slang, $description, $sentence);
```

### Delete Slang

```
    $dictionary->deleteOne($slang);
    
    $dictionary->deleteAll();
```



### Implement Ranking

The ranking system is implemented using the ``rankWords()`` method.

You can now traverse through the Data array to get your desired output like so:

```
foreach(Data::$data as $row => $innerArray)
{   

    $res = $innerArray['Sample-sentence'];

    $getRank = $ranker->rankAndSort($res);

    $output = '';

        foreach($getRank as $key => $value)
        {
            $output .= "$key => $value".', ';
        }

        $output = rtrim("[".$output,','."]")."<br>";

        // print the final output

        echo $output;
        echo "<br>";
}
```

Sample Output:
```
[“Tight” => 3, “Prosper” => 2, “Yes” => 1, “Have” => 1, “you” => 1, “finished” => 1, “the” => 1, “curriculum?” => 1]

```
