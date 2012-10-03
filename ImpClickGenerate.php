<?php

for ($i=0; $i < 1000; $i++) { 
	$clicks_available = return_valid_clicks(oas_tag_impression(decide_which_site()));

  $was_clicked = false;

	if(rand(0, 1000) < 200){
	  curl_calls(click_random_tag($clicks_available));
    $was_clicked = true;
    echo $i . " --> CURL sent with click \n";
	}

  if(!$was_clicked){ echo $i . " --> Only impression generated \n"; }
}

function decide_which_site()
{
  $domain = "http://[YOUR OAS DE ADDRESS]/";                               	// Delivery Engine Address
  $tgtype = "RealMedia/ads/adstream_mjx.ads/";                              // Type of Tag (Only MJX for Now)
  $pslist = "@x01,x02,x03,x04,x05,x06,Top,Bottom,Right,Right1,Left,Left1";  // Position List

  $pglist = array(0 => "site1/home/",
                  1 => "site2/home/",
                  2 => "site2/page1/",
                  3 => "site3/page2/",
                  4 => "site4/home/" );                                		// Page List

  $myRnd = 7;

  for ($i=0; $i < 9; $i++) { $myRnd .= rand(0, 9); }

  return $domain . $tgtype . click_random_tag($pglist) . $myRnd . $pslist;
}

function oas_tag_impression($site)
{
  return curl_calls($site);
}

function curl_calls($url)
{
  $ch = curl_init();
  $timeout = 0;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function click_random_tag($possible_clicks)
{
  $chosen = rand(0, count($possible_clicks) -1 );
  return $possible_clicks[$chosen];
}

function return_valid_clicks($content)
{
  $regex_pattern = "/<A HREF=\"(.*)\">(.*)<\/A>/";
  preg_match_all($regex_pattern,$content,$matches);

  $clicks = array();

  foreach ($matches[1] as $clicktag) {
  	$tmp = explode("\"", $clicktag);
  	if ( !strrpos($tmp[0] , "empty.gif") )
  		$clicks[] = $tmp[0];
  }

  return $clicks;
}
?>
