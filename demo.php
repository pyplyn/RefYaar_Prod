<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $i = 0;
            foreach($_GET["anurag"] as $item){
                echo $item ."/".$_GET["sameer"][$i]."<br/>";
                $i++;
            }
        ?>
        <form>
            <div>
                <input type="text" name="anurag[]" />
                <input type="text" name="sameer[]" />
            </div>
            
            <div>
                <input type="text" name="anurag[]" />
                <input type="text" name="sameer[]" />
            </div>
            
            <div>
                <input type="text" name="anurag[]" />
                <input type="text" name="sameer[]" />
            </div>
            <input type="submit" />
        </form>
    </body>
</html>
