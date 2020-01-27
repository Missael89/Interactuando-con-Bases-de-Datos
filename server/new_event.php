<?php

  include 'conexionBD.php';
  $Titulo=$_POST['titulo'];
  $FechaInicio=$_POST['start_date'];
  $TodoDia=$_POST['allDay'];
  $FechaFinal=$_POST['end_date'];
  $HoraFinal=$_POST['end_hour'];
  $HoraInicial=$_POST['start_hour'];

  CrearEvento();

  function CrearEvento(){
    IniciarConexion();
    
    if ($GLOBALS['TodoDia'] === 'false'){
        $valorTodoDia = 0;
        $horaIni = "'".$GLOBALS['HoraInicial']."'";
        $fechaFin = "'".$GLOBALS['FechaFinal']."'";
        $horaFin = "'".$GLOBALS['HoraFinal']."'";
    }else{
        $valorTodoDia = 1;
        $horaIni = 'null';
        $fechaFin = 'null';
        $horaFin = 'null';
    }
    
    $Consulta = "INSERT INTO evento (IdUsuario, Titulo, FechaInicio, HoraInicio, FechaFinalizacion, HoraFinalizacion, DiaCompleto)
    VALUES (".$_COOKIE['IdUser'].", '".$GLOBALS['Titulo']."', '".$GLOBALS['FechaInicio']."', ".$horaIni.", ".$fechaFin.", ".$horaFin.", ".$valorTodoDia.")";

    if ($GLOBALS['Conexion']->query($Consulta) === TRUE) {
        echo json_encode(array("msg"=>"OK","Id"=>$GLOBALS['Conexion']->insert_id));
    } else {
        echo json_encode(array("msg"=>$Consulta));
    }
    DesactivarConexion();
  }

 ?>
