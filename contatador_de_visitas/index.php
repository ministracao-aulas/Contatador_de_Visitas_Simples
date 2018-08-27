<?php
        //Contador de visitas simples
        $texto_contador = "Número de visitas";
        $arquivo="contador.ctr";
        
        if (isset($_GET['texto'])){
                $texto_contador = $_GET['texto'];
        }

        if (isset($_GET['limpar'])){
                $fp = fopen($arquivo, "w");
                fwrite($fp, 0);
                fclose($fp);
        }else{
                $fp = fopen($arquivo, "r");
                $count = fread($fp, 1024);
                fclose($fp);
                $count = $count + 1;
                echo "<span class='page-view'>$texto_contador: " . $count . "</span>";
                $fp = fopen($arquivo, "w");
                fwrite($fp, $count);
                fclose($fp);
        }       
         
        if (isset($_GET['valor'])){
                $count = $_GET['valor'] -1;
                $fp = fopen($arquivo, "w");
                fwrite($fp, $count);
                fclose($fp);
        }
?>
