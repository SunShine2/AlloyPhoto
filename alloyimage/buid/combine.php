<?php
$isCom = $_GET['c'];

$files = scandir("../src/module/");
$contents = file_get_contents("../src/alloyimage.base.js");
foreach($files as $file){
    if(preg_match("/[^\.]+\.js$/",$file)){
        $contents .= file_get_contents("../src/module/".$file);
    }
}
$wfile = fopen("../combined/alloyimage.js","w+");
if(fwrite($wfile,$contents)){
    echo "combined OK <br />";
    if($isCom == "c"){
        if($m = exec("mm")){
            echo "Compile Completed";
        }else{
            (shell_exec("`java -jar compiler.jar ..\combined\alloyimage.js --js_output_file=..\combined\alloyimage2.js`"));
            echo "<span style='color:red'>error occured with compiling</span>";
        }
    }else
        echo "combined with non-compile OK";
}
