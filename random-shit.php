<?php
/*
* Rebuild by Shahril and Munajaf
* Learning Regex trololololo
* Coded By Shahril 
* Styled, Cut,Paste every random shit by Munajaf
* Some Shit From http://pastebin.com/7aE0ZCYk
*
* 1.0 - adf.ly,q.gs,linkbucks,tinybucks,urlcash,lix.in,anonym.to, adik beradik goo.gl pn bole!
*     - Example1 : http://lix.in/-ceec7a
*     - Example2 : http://goo.gl/e4SPw
*
* 1.1 - added anonymz.com,adfoc.us some bug fix
*     - http://adfoc.us/x19219978
*     - http://www.anonymz.com/?http://google.com/
*
* 1.2 - xss bug fix, hope so ;D - thx to p0pc0rn 
*     - learned some new regex http(s?) -thx to Ahlspiess
*
* 1.3 - iic.my,adfa.st,linkc.at,ad7.biz
*     - http://adfa.st/M12w
*     - http://iic.my/z
*
* 1.4 - new linkbucks domain (theseblogs.com)
*     - http://68ba306b.theseblogs.com
*
* 1.5 - Add New ADF.LY Bypass Algorithm (Credit to Personant)
*     - My personal message to Adf.ly -> "You mad adf ? You wasted lot of money to created
*                                         that useless protection and somebody already
*                                         created a method to bypass it."
*       By the way, Personant created this function long time ago, only me too lazy to implement it...
*
* 1.0 - 15/2/2013
* 1.1 - 17/2/2013
* 1.2 - 18/2/2013
* 1.3 - 21/2/2013
* 1.4 - 06/7/2013
* 1.5 - 04/10/2013
*/

$CounT = true; //set this to true if you want it to count the link have been skiped, " else " put it false
if(!file_exists('link.txt'))
{
    fwrite(fopen('link.txt','w'), "0");
}

if(!in_array("curl", @get_loaded_extensions()))
{
    die('Curl Is Not Supported!');
}

?>
<title>Random Shit Bypasser 1.5</title>
<style>
@import url(http://fonts.googleapis.com/css?family=Fredoka+One);@import url(http://fonts.googleapis.com/css?family=Alike);
body {background:url('http://goo.gl/ZHzmP'); font: 75%/170% Arial, Helvetica, sans-serif;}
a:visited {COLOR: #0066cc;text-decoration: none;cursor:pointer;}
a:link {COLOR: rgb(6, 118, 146);text-decoration: none;cursor:pointer;}
textarea{font-family: 'Fredoka One', cursive;font-weight:200;font-size: 14px;padding:5px;box-shadow: rgba(255, 255, 255, .75) 0px 0px 9px 1px;background-color:rgba(0, 0, 0, .25);    color: rgb(6, 118, 146);;border-radius:5px;height: 198px; width: 887px;margin-top: 20px;margin-bottom: 5px;}
.link{font-size:12px;}
.shittendstohappen{font-size:12px; color:red}
.head{color: #FFF;font-family: 'Fredoka One', cursive;font-size: 50px;font-weight:400;}
.foot{font-family: 'Fredoka One', cursive;padding: 2px;border-top: 1px solid #EBEBEB;background-color: #FFF;bottom:0;position:fixed;width:100%;height: 20px;font-size: 15px;}
.number{ font-size:15px; color:#fff;}
.button {display: inline;position: relative;font-size: 15px;font-weight: bold;text-align: center;text-decoration: none;color: white;border-radius: 5px;padding: 14px 80px;}
.bypass {margin: 20px;background-color: #333;text-shadow: 0 -1px -1px #1B3D82;}
.bypass:hover {background-color: rgb(6, 118, 146);box-shadow: rgba(255, 255, 255, .75) 0px 0px 9px 1px;}
</style>
<?php
echo '<center><br /><br />
<div class="head">Random Shit Bypasser</div> <br /> <br />
<form method="post">
<textarea name="urllist">'.htmlspecialchars($_POST['urllist'], ENT_QUOTES).'</textarea>
<br />
<input type=submit name="sub" class="button bypass" value="Bypass"/>
</form><br />';


if(isset($_POST['urllist']) && !empty($_POST['urllist'])){
    $array = array();
    $i = 1;
    $_POST['urllist'] = str_replace("\r", "", html_entity_decode($_POST['urllist']));
    $list = explode("\n", $_POST['urllist']);
    echo '<table border="1">';
    echo '<tr><th><font color="#fff">No .</font></th><th><font color="#fff">Link</font></th></tr>';
    foreach($list as $a)
    {
        if(empty($a)){
            continue;
        }

        else
        {
            // Xss Fix htmlentities, shahril biatch :3
            $exp = htmlentities(get($a));
            if($exp === "ShitHappen1"){
                echo '<tr><th><font class="number">'.$i++.'</font></th><th>&nbsp;&nbsp;&nbsp;<font class="shittendstohappen">Can\'t bypass that link!</font>&nbsp;&nbsp;</th></tr>';
            }
			// kalau $exp return javascript:alert(1);
			// strpos akan return int(0) sebab javascript position number 0 pada string tersebut dan dalam php; jikalau kita compare ==0 sama maksud macam kita compare ==false, jadi untuk letak kekeliruan se-eloknya guna !== false untuk compare same data-type.
            elseif(strpos(strtolower(urldecode($exp)), "javascript:") !== false || $exp === "ShitHappen2"){
                echo '<tr><th><font class="number">'.$i++.'</font></th><th>&nbsp;&nbsp;&nbsp;<font class="shittendstohappen">Link provide is offline or not exist!</font>&nbsp;&nbsp;</th></tr>';
            }else{
                /*if(strpos(strtolower(urldecode($exp)), "javascript:")){
                    $exp = "xxxAtempt";
                }elseif(strpos(strtolower(urldecode($exp)), "<script>")){
                    $exp = "xxxAtempt";
                }elseif(strpos(strtolower(urldecode($exp)), "alert(")){
                    $exp = "xxxAtempt";
                }else{*/
                    array_push($array, $exp);
                    echo '<tr><th><font class="number">'.$i++.'</font></th><th>&nbsp;&nbsp;&nbsp;<a href="'.$exp.'"><font class="link">'.$exp.'</font></a>&nbsp;&nbsp;&nbsp;</th></tr>';}
                //}
            }
        }
        
          echo '</table>';
      
        # -- Count Random Shit Bypassed -- #
        if($CounT){
            $count = count($array);
            $handle = fopen('link.txt', "r");
            $num = fread($handle, filesize('link.txt'));
            fclose($handle);
            $numoflink = ($num + $count);
                        
            $handle = fopen('link.txt', "w");
            fwrite($handle, (int)$numoflink);
            fclose($handle);
        }

        # -- Count Random Shit Bypassed -- #
}

echo "<br /><br /><br />";
# -- Count Random Shit Bypassed -- #
if ($CounT) echo "<center><div class='foot'>Number Of SHIT Bypassed on ".htmlentities($_SERVER["HTTP_HOST"], ENT_QUOTES, "utf-8")." is <b><u>".countLink()."</u></b></div></center>";

function countLink()
{
    if($handle = fopen('link.txt', "r"))
    {
        $realnumoflink = fread($handle, filesize('link.txt'));
        fclose($handle);
        return $realnumoflink;}

}
# -- Count Random Shit Bypassed -- #

function get($link){
        if(!preg_match('/(http|https)/', $link)){
                $link = "http://".$link;
        }
        if(check($link)){
                $first = bypass($link);
                if($first !== false){
                        for(;;){
                                $test = bypass($first);
                                if($test === false){
                                        break;
                                }else{
                                        $first = $test;
                                }
                        }
                        return $first;
                }else{
                        return "ShitHappen1";
                }
        }else{
                return "ShitHappen2";
        }
}

function bypass($link){
        $get = curl($link);
        if(strpos($get, "Location:")){
                preg_match_all('/Location: (.*?)\\r\\n/', $get, $out);
                return $out[1][0];
        }elseif(preg_match('/http(s?):\/\/(www\.)?(q.gs|adf.ly|j.gs|u.bb)\/.*/', $link) ){
                preg_match_all('/var ysmm \= \'(.*?)\'\;/', $get, $out);
                return adfly_decode($out[1][0]);
        }elseif(preg_match('/http(s?):\/\/(www\.)?.*\.(linkbucks.com|tinybucks.net|theseblogs.com)/', $link) ){
                preg_match_all('/Lbjs\.TargetUrl \= \'(.*?)\'/', $get, $out);
                return $out[1][0];
        }elseif(preg_match('/http(s?):\/\/(www\.)?go\.urlcash\.net\/.*/', $link)){
                preg_match_all('/linkDestUrl \= \'(.*?)\'/', $get, $out);
                return $out[1][0];
        }elseif(preg_match('/http(s?):\/\/(www\.)?lix\.in\/.*/', $link)){
                preg_match('/name=\'tiny\' value=\'(.*?)\'/', $get, $out);
                $data = curl($link, "tiny=".$out[1]."&submit=continue&submit=submit");
                preg_match('/src\=\"(.*?)\"/', $data, $out);
                return $out[1];
        }elseif(preg_match('/http(s?):\/\/(www\.)?anonym\.to\/\?.*/', $link)){
                preg_match('/<p id=\"url\"><a href=\"(.*?)\"/', $get, $out);
                return $out[1];
        }elseif(preg_match('/http(s?):\/\/(www\.)?anonymz\.com\/\?.*/', $link)){
                preg_match('/<meta http-equiv=\"refresh\" content=\"0\; url=(.*)\">/', $get, $out);
                return $out[1];
        }elseif(preg_match('/http(s?):\/\/(www\.)?adfoc\.us\/.*/', $link)){
                preg_match('/[^\/\/]var click_url \= \"(.*?)\"\;/', $get, $out);
                return $out[1];
        }elseif(preg_match('/http(s?):\/\/iic\.my\/.*/', $link)){
                preg_match_all('/top\.location \= \'(.*?)\'/', $get, $out);
                return $out[1][0];
        }elseif(preg_match('/http(s?):\/\/adfa\.st\/.*/', $link)){
                preg_match('/<a href=\"(.*)\"><button/', $get, $out);
                return $out[1];
        }elseif(preg_match('/http(s?):\/\/linkc\.at\/.*/', $link)){
                $get = curl($link, "text=&image=");
                preg_match('/window\.location \= \'(.*)\'<\/script>/', $get, $out);
                return $out[1];
        }elseif(preg_match('/http(s?):\/\/ad7\.biz\/.*/', $link)){
                preg_match_all('/border\=0 src\=\"(.*)&url\=(.*)&ref\=/', $get, $out);
                return $out[2][0];
        }elseif(preg_match('/t\.co/i', $link)){
                preg_match('/content="0;URL=(.*?)"/i', $get, $out);
                return $out[1];
        }else{
                return false;
        }
}
 
function check($url){
  $ch=curl_init();
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch,CURLOPT_VERBOSE,false);
  curl_setopt($ch,CURLOPT_TIMEOUT, 1);
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch,CURLOPT_SSLVERSION,3);
  curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
  $page=curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if($httpcode>=200 && $httpcode<402) return true;
  else return false;
}
 
function curl($url, $post = ""){
  $ch = @curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.28 (KHTML, like Gecko) Chrome/26.0.1397.2 Safari/537.28");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'));
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  if($post){
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  }
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
  $page = curl_exec( $ch);
  curl_close($ch);
  return $page;
}

function adfly_decode($code){
  $chunk1 = $chunk2 = '';
  for($i = 0; $i < strlen($code); $i++) $i&1 ? $chunk1 = $code[$i].$chunk1 : $chunk2 .= $code[$i];
  return substr(base64_decode($chunk2.$chunk1), 2);
}

?>
