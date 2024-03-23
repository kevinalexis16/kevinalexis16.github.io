<?php
error_reporting(E_ERROR | E_PARSE);

$filelink='https://filemoon.sx/e/'.$_GET['v'].'';
if (strpos($filelink,"filemoon.") !== false) {
  if (preg_match('/(\/\/[\.\d\w\-\.\/\\\:\?\&\#\%\_\,]*(\.(srt|vtt)))/', $filelink, $s))
    $srt="https:".$s[1];
   require_once("JavaScriptUnpacker.php");
   require_once ("tear.php");
   $ua="Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Mobile Safari/537.36";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $filelink);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, $ua);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_ENCODING,"");
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
   curl_setopt($ch, CURLOPT_TIMEOUT, 25);
   $h = curl_exec($ch);
   curl_close($ch);

  $out="";
  if (preg_match("/eval\(function\(p,a,c,k,e,[r|d]?/",$h)) {
  $jsu = new JavaScriptUnpacker();
  $out = $jsu->Unpack($h);
  }

  if (preg_match("/sources\:\[\{file\:\"([^\"]+)\"/",$out,$m))
    $link=$m[1];
   if ($link && $flash <> "flash");
}
echo $lin;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Filemoon Video Player</title>
    <meta name="robots" content="noindex">
    <meta name="referrer" content="never">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://cdn.rawgit.com/ufilestorage/a/master/skins/jw-logo-bar.css" rel="stylesheet" type="text/css">
    <script src="https://content.jwplatform.com/libraries/KB5zFt7A.js"></script>
    <script>jwplayer.key = "XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo";</script>
    <style type="text/css">
        body, html {
            margin: 0;
            padding: 0
        }

        #uplay_player {
            position: absolute;
            width: 100% !important;
            height: 100% !important;
            border: none;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div id="uplay_player"></div>
<script type="text/javascript">
    var videoPlayer = jwplayer("uplay_player");
    videoPlayer.setup({
        sources: [{'file': '<?= $link ?>', 'type': 'video/mp4'}],
        width: "100%",
        height: "100%",
        controls: true,
        displaytitle: false,
        fullscreen: true,
        primary: "html5",
        autostart: false,
        advertising: {
            client: "vast",
            tag: "#"
        },
        tracks: [{
            file: "<?php echo isset($srt) ? $srt : ''; ?>",
            label: "Subs",
            kind: "captions",
            default: true,
        }],
        captions: {
            color: "#FFFF00",
            fontSize: 14,
            edgeStyle: "uniform",
            backgroundOpacity: 0,
        },
        logo: {
            file: "#",
            logoBar: "",
            position: "top-left",
            link: ""
        },
        aboutlink: "",
        abouttext: "",
        sharing: {},
    });
    videoPlayer.on("ready", function () {
        jwLogoBar.addLogo(videoPlayer);
    });
    videoPlayer.addButton(
        "https://raw.githubusercontent.com/ufilestorage/img/master/download.png",
        "Download Movie",

        function () {
            window.open(videoPlayer.getPlaylistItem()["file"] + "", "_blank").blur();
        }, "download"
    );
</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4772667&101" alt="estadisticas web" border="0"></a></noscript>
</body>
</html>