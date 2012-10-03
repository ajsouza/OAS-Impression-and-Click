#Generate Impressions and Clicks for Open AdStream
I recently had a situation in which I was doing some integration testing of OAS and needed to generate some impression and click data, however, as I am restricted to a non-production environment there is generally no impressions and clicks for the campaigns being generated. The ImpClickGenerate.php script is a quick and easy way of generating some random impressions and clicks for a given set of pages. Additional info forthcoming on my [blog](http://openadstream.blogspot.com/)

Sample Usage
============ 
To use this code you MUST make the following alterations (lines 19 & 23);

```PHP
  // Include the domain of your DE's
  $domain = "http://[YOUR OAS DE ADDRESS]/"; 
  
  // This will be YOUR site/page list
  $pglist = array(0 => "site1/home/",
                  1 => "site2/home/",
                  2 => "site2/page1/",
                  3 => "site3/page2/",
                  4 => "site4/home/" );
```