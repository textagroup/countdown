# SilverStripe Countdown Widget

## Maintainer Contact

* Kirk Mayo (Nickname: textagroup) <kirk.mayo@solnet.co.nz>

## Requirements

* SilverStripe 3.1

## Documentation

Adds a countdown widget to a SilverStripe page widget

## Installation

	composer require "textagroup/countdown"
	
## Setup

To setup a countdown timer the first thing to do is to apply the CoundownWidgetExtension to the page object.

This can be setup in the config yml file as per the example below which will add it to all pages

```
Page:                                                                           
  extensions:                                                                   
    - CountdownWidgetExtension 
```

or alternatively you can apply the extension through some PHP code

```
Member::add_extension('MyMemberExtension');
```

This will add a countdown tab to the page in the CMS where you can set the Countdown date and the format of the countdown.

Then you need to setup where you want the countdown to appear by adding the the variable $Countdown to the relevant SilverStripe template.

```
<div class="main" role="main">                                                  
        <div class="inner typography line">                                     
                $Countdown                                                      
                $Layout                                                         
        </div>                                                                  
</div>  
```

This will add a div or span to your page with a Countdown timer you can then style the div or span via css via the relavant class (CountdownDiv, CountdownSpan)

[See the following page for examples and information of the jQuery module used](http://hilios.github.io/jQuery.countdown/)

## Functionality
This module adds a countdown timer to a SilverStripe page and a date field to the cms section for the page which is used to set the countdown date

##TO DO
* Add a configurable ID or Class to the Countdown div/span
