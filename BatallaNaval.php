<?php
    //-------------------------------------------------------------------------------//
    /*
        Acosta Durán Luna Fernanda
        Figueroa Hernández Fernando

        NOTA: ya nos moriamos de sueño, cansancio y dolor muscular pero intentamos encontrar 
        una alternativa con lo que teniamos. Esta alternativa fue desplegar el nombre de las
        casillas donde si hay barco y poner el mensaje de que gano cuando los disparos y los
        barcos coincidan completamente.
        Cumplimos con:
        -Título del juego
        -Visualizar casillas a las que se disparó y habia barco (no en la tabla pero si se 
            muestra)
        -En caso de atinar a todos los blancos deberán mostrar que diga que ganaron
        -Para disparar se deberá usar dos inputs que permitan a través de coordenadas seleccionar 
            la casilla a la cual se va a disparar
        -Los barcos se deben generar de aleatoria
        -Mostrar un historial de disparos que ha hecho el usuario.
        -Se deben generar 2 Barcos: uno de 3 de longitud y otro de 4 de longitud; un tablero de 
            10x10

        PD: tenemos pensado completarlo algun dia
    */ 
    //-------------------------------------------------------------------------------//
    
    $cor_y = (isset($_POST["letra"]) && $_POST["letra"] != "" )?$_POST["letra"] : "";
    $cor_x = (isset($_POST["numero"]) && $_POST["numero"] != "" )?$_POST["numero"] : "";
    $historial = (isset($_POST["historial"]) && $_POST["historial"] != "" )?$_POST["historial"] : "";
    $barcos = (isset($_POST["barcos"]) && $_POST["barcos"] != "" )?$_POST["barcos"] : "No hay dato";
    $disps = (isset($_POST["disps"]) && $_POST["disps"] != "" )?$_POST["disps"] : "";
    //$vidas2 = (isset($_POST["vidas2"]) && $_POST["vidas2"] != "" )?$_POST["vidas2"] : "";
    
    //-------------------------------------------------------------------------------//
    echo "<h1><i>Batalla Naval</i></h1>";
    $vidas = 0;
    $disparo = "";
    $cadena_disp = [];
    $barco_1_1 = rand(1, 10);
    $barco_1_2 = rand(1, 10);
    $barco_2_1 = rand(1, 10);
    $barco_2_2 = rand(1, 10);
    $por_si_acaso = ["A1", "A2", "A3", "A4", "G7", "G8", "G9"];
    $pantalla = 0;
    $disparo_estado = $bool=0;
    $coordenadas=[$cor_y, $cor_x];
    //arreglo para relacionar letras con numeros
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
    //Validaciones------------------------------------------------------------------------//
    //...Generar barcos...//
    if(!isset($_POST["barcos"]))
    {
        if($barco_1_1<=10)
        {
            foreach($casilla_y as $num => $letra) {
                if($barco_1_1==$num)
                {
                    $barco_1_1=$letra;
                }
            }
        }
        $barco1_inicio = [$barco_1_1.$barco_1_2];
        if($barco_1_2<=6)
        {
            for($i=1; $i<=3; $i++)
            {
                $barco_1_2+=1;
                $x=$barco_1_1.$barco_1_2;
                array_push($barco1_inicio, $x);
            }
        }elseif ($barco_1_2>=6) {
            for($i=1; $i<=3; $i++)
            {
                $barco_1_2-=1;
                $x=$barco_1_1.$barco_1_2;
                array_push($barco1_inicio, $x);
            }
        }
        //creando barco 2 con extensión de 3 casillas
        if($barco_2_1<=10)
        {
            foreach($casilla_y as $num => $letra)
            {
                if($barco_2_1==$num)
                {
                    $barco_2_1=$letra;
                }
            }
        }
        if($barco_2_2<=6)
        {
            for($i=1; $i<=3; $i++)
            {
                $barco_2_2+=1;
                $x=$barco_2_1.$barco_2_2;
                array_push($barco1_inicio, $x);
            }
        }elseif ($barco_2_2>=6) {
            for($i=1; $i<=3; $i++)
            {
                $barco_2_2-=1;
                $x=$barco_2_1.$barco_2_2;
                array_push($barco1_inicio, $x);
            }
        }
        
        $naves = $barco1_inicio;
    }
    else
    {
        $naves = $barcos;
    }
    //..Cadena de disparos....//
    $disparo=implode("", $coordenadas);
    if(!isset($_POST["disps"])&&isset($_POST["barcos"]))
    {
        
        foreach ($barcos as $value) {
            if($disparo==$value)
            {
                array_push($cadena_disp, $disparo);
            }
        }
        $cañonazo = $cadena_disp;
    }
    elseif(isset($_POST["barcos"]))
    {
        foreach ($barcos as $value) {
            if($disparo==$value)
            {
                array_push($disps, $disparo);
            }/*
            else{
                if(!isset($_POST["life"]))
                {
                    $vidas-=1;
                    $vids=$vidas;
                }
                else
                {
                    $life-=1;
                    $vids=$life;
                }
            }*/
        }
        $cañonazo = $disps;
    }
    
    //-----------------------------------------------------------------------------------------------//
    
    
    $historial.=", ".$disparo;
    $ganar = 0;
    $vidas2 = 0;
    
    //Permite checar los valores de la cadena cañonazo para compararla con la ubicacion de los barcos
    //si coinside sube un punto a ganador, que al llegar a 7 envia el mensaje (lineas 221 a 226)
    echo "Tiros buenos: ";
    echo "<br>";
    if(isset($_POST["barcos"]))
    {
        foreach ($barcos as $value) {
            foreach ($cañonazo as $balas) {
                if($value==$balas)
                {
                    //imprime el nombre de las casillas dd se identifico que hay una parte de un barco
                    echo $balas;
                    echo "<br>";
                    //si detecta una parte de barco incrementa la variable ganar en uno
                    $ganar+=1;
                }
            }
        }
    }
    
    //principalmente...si la variable ganar es menor a 7 (si no se han encontrado todas las bartes de barco) hará lo siguiente
    if($vidas2<=8&&$ganar<7)
    {
        /*echo "<h3>Vidas: </h3>";
        for($i=1; $i<=$vidas; $i++)
        {
            echo "<img src='https://png.pngtree.com/png-vector/20191008/ourlarge/pngtree-bullet-icon-in-cartoon-style-png-image_1799886.jpg' alt='bala' height='20'>";
        }*/
        
        echo "<br><br>";
        echo "Historial: <br>";
        //imprime el historial de disparos
        echo $historial;
        echo "<br><br>";
        //crea el tablero, que en esta modalidad ayudará de guia
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
                        for($cuadro=1; $cuadro<=10; $cuadro++)
                        {
                            echo "<td>";
                                if($disparo_estado==0)
                                {
                                    echo "<img src='./agua.png' alt='imagen de agua' height='25'>";
                                }
                                else
                                {
                                    if ($disparo_estado==1&&$y==$cor_y&&$cuadro==$cor_x) 
                                    {
                                        echo "<img src='./tiro_bueno.png' alt='imagen de agua' height='25'>";
                                        $disparo_estado=true;
                                    }
                                    else
                                    {
                                        if ($disparo_estado==2&&$y==$cor_y&&$cuadro==$cor_x) 
                                        {
                                            echo "<img src='./tiro_malo.png' alt='imagen de agua' height='25'>";
                                            $disparo_estado=false;
                                            $vidas-=1;
                                        }
                                    }
                                }
                            echo "</td>";
                        }
                    echo "</tr>";     
                }
            echo "</tbody>";
        echo "</table>";
        echo "<br>";
        echo "<form action='./BatallaNaval.php' method='POST'>";
            echo "Coordenada X(numero): <input type='number' name='numero' min='0', max='10' required>";
            echo "Coordenada Y(letra): <input type='text' name='letra' required>";
            echo "<input type='hidden' name='historial' value='$historial'>";
            //aprendimos como enviar arreglos por hidden
            foreach ($naves as $coordenad) {
                echo "<input type='hidden' name='barcos[]' value='$coordenad'>";
                //echo $coordenad;
            }
            if(isset($_POST["barcos"]))
            {
                foreach ($cañonazo as $disp) {
                    echo "<input type='hidden' name='disps[]' value='$disp'>";
                    //echo $disp;
                }
            }
            echo " <input type='submit' value='Dispara!!!!'>";
        echo "</form>";
        //echo "Coordenadas de barcos: ";
        //var_dump($barcos);
        //echo "<br>";
        //echo "Cadena disparos: ";
        //var_dump($disps);
    }
    //si la variable ganar es 7 (se encontraron todas las partes de barcos) imprimirá el mensaje ganador
    elseif($vidas2<=8&&$ganar==7) 
    {
        echo "<h1><i>¡¡¡GANASTE!!!</i></h1>";
        echo "<h2><i>Has eliminado todos los barcos enemigos</i></h2>";
        //un GIF jijiji
        echo " <img src='https://media.tenor.com/images/a2c75e7f112244519ca3e8f0a9f53099/tenor.gif' alt='GIF ganaste' width='300'>";
    }
    elseif($vidas2>8) 
    {
        echo "<h1><i>¡¡¡PERDISTE!!!</i></h1>";
        echo "<h2><i>Has perdido todas tus vidas</i></h2>";
        echo " <img src='https://media.tenor.com/images/26849e8a0223747d1d602f65843dbc6c/tenor.png' alt='Imágen perdiste' width='300'>";
    }
?>
