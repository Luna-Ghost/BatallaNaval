<?php
    //-------------------------------------------------------------------------------//
    
    $cor_y = (isset($_POST["letra"]) && $_POST["letra"] != "" )?$_POST["letra"] : "No hay dato";
    $cor_x = (isset($_POST["numero"]) && $_POST["numero"] != "" )?$_POST["numero"] : "No hay dato";
    
    //-------------------------------------------------------------------------------//
    echo "<h1><i>Batalla Naval</i></h1>";
    $vidas=8;
    $historial="";
    $ayuda="";
    $barco_1_1 = rand(1, 10);
    $barco_1_2 = rand(1, 10);
    $barco_2_1 = rand(1, 10);
    $barco_2_2 = rand(1, 10);
    $pantalla="";
    $coordenadas=[$cor_y, $cor_x];
    $casilla_y =    [
                        1 => "A",
                        2 => "B",
                        3 => "C",
                        4 => "D",
                        5 => "E",
                        6 => "F",
                        7 => "G",
                        8 => "H",
                        9 => "I",
                        10 => "J"
    ];
    echo "<h3>Vidas: </h3>";
    echo $barco_1_1.",".$barco_1_2;
    echo $barco_2_1.",".$barco_2_2;
    
    while($vidas>0)
    {
        for($i=1; $i<=$vidas; $i++)
        {
            echo "<img src='https://png.pngtree.com/png-vector/20191008/ourlarge/pngtree-bullet-icon-in-cartoon-style-png-image_1799886.jpg' alt='bala' height='20'>";
        }
        //$ayuda=implode("", $coordenadas);
        //$historial.=", ".$ayuda;
        echo "<br><br>";
        echo "Historial: <br>";
        //echo $historial;
        echo "<br><br>";
        echo "<table border='1'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th></th>";
                    for ($x=1; $x<=10; $x++)
                    {
                        echo "<th>";
                        echo $x;
                        echo "</th>";
                    }
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                for($y=1; $y<=10; $y++)
                {
                    echo "<tr>";
                        echo "<td>";
                            foreach ($casilla_y as $num => $letra) 
                            {
                                if($y==$num)
                                {
                                    echo $letra;
                                }
                            }
                        echo "</td>";
                        switch($pantalla)
                        {
                            case 0:
                                for($cuadro=1; $cuadro<=10; $cuadro++)
                                {
                                    echo "<td>";
                                        echo "<img src='./agua.png' alt='imagen de agua' height='25'>";
                                    echo "</td>";
                                }
                                break;
                        }
                    echo "</tr>";     
                }
            echo "</tbody>";
        echo "</table>";
        echo "<form action='./BatallaNaval.php' method='POST'>";
            echo "Coordenada X(numero): <input type='number' name='numero' min='0', max='10' required>";
            echo "Coordenada Y(letra): <input type='text' name='letra' required>";
            echo "  <input type='submit' value='Dispara!!!!'>";
        echo "</form>";
        $vidas-=1;
    }
    echo "<h1><i>¡¡¡PERDISTE!!!</i></h1>";
    echo "<h2><i>Has perdido todas tus vidas</i></h2>";
    
?>
