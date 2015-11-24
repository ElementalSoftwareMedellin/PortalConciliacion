<?php 
session_start();
include 'conexion/conection.php';
if (isset($_SESSION["User_Type"])) 
{
$tipoiniciada=$_SESSION["User_Type"] ;
  if ($tipoiniciada != "") 
  {
    echo "<meta HTTP-EQUIV='REFRESH' content='0; url=inicio.php'>";
  }
}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Log-in</title>
    <link rel="stylesheet" href="css/styleLogin.css">
        <!-- Iconos -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
  </head>
  <body>
    <script type="text/javascript">
      $(document).ready(function () {

        var campo1 = "";
        var campo2 = "";
        var tipo = "";
        var empresa = "";

        $("#form").attr("style","display: none");
        $('#colegio').change(function()
        {  
          if ($(this).val() == 0 )
          {
             $("#form").attr("style","display: none");
          }
          else
          {
            $("#form").removeAttr("style");
            $("#seleccionar_colegio").attr("style","display: none");

            $("#infoColegio").text($("#colegio option:selected").text());
          }
        });
        <?php
          if(isset($_GET["error"]))
          {
            echo "alert('".$_GET['error']."');";
            echo "$('#infoError').text('".$_GET['error']."');";
          }
          
        ?>
        $('input[type=radio][name=tipo]').change(
          function()
          {
            tipo = $('input:radio[name=tipo]:checked').val();
            if (tipo =="A") 
            {
              $("#campo1").attr("placeholder","Matricula");
              $("#campo2").attr("placeholder","Repita la Matricula");
              $("#campo2").attr("type","text");
             // $("#campo1").val("");
              $("#campo2").val("");
            }
            else if (tipo =="D")
            {
              $("#campo1").attr("placeholder","Usuario");
              $("#campo2").attr("placeholder","Contraseña");
              $("#campo2").attr("type","password");
             // $("#campo1").val("");
              $("#campo2").val("");
            }
          }
        );

        $("#ingresar").click(function(){
           campo1=$("#campo1").val();
           campo2=$("#campo2").val();
           tipo = $('input:radio[name=tipo]:checked').val();           
           empresa = $("#colegio option:selected").val();

           $.post('conexion/sesion.php',{Campo1: campo1,Campo2: campo2, Tipo: tipo, Empresa:empresa}, function(data)
           {
              if(data == "administrador")
              {
                location.replace("inicio.php");
              }
              else if(data == "alumno")
              {
                location.replace("inicio.php");
              }
              else if(data == "docente")
              {
                location.replace("inicio.php");
              }
              else
              {
                $("#infoError").text(data);
              }            
           });
        });
        

      });
    </script>
    <div class="login">
      <div class="heading">
        <center><a href="index.php"><img src="images/CalasanzTransparente.png" width="50%" ></a></center>
        <h2></h2>
          <div id="seleccionar_colegio">
            <select name="colegio" id="colegio">
              <option  value="0" >Seleccione Institucion</option>
              <?php
                $sql= "SELECT id_empresa,nombre_empresa FROM empresa;";
                $result = mysql_query($sql) or ("error al consultar empresa.");
                while($row = mysql_fetch_array($result))
                {
                  echo "<option value='".$row['id_empresa']."'>".$row['nombre_empresa']."</option>";
                }
                    
              ?>
            </select>
          </div>
        <div id="form">
          <b>- <label id="infoColegio" style="color:green;"></label> -</b>
          <div class="input-group input-group-lg">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input id="campo1" type="text" class="form-control" placeholder="Matricula"/>
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input id="campo2" type="text" class="form-control" placeholder="Repita la Matricula"/>
            <br>
            <label id="infoError" style="color:red;"></label>
            <br>
          </div>
          <div class="">
            <label>Docente </label><input type="radio" name="tipo" value="D" />
            <label>Alumno  </label><input type="radio" name="tipo" value="A" checked/>
          </div>
          <button id="ingresar" >Ingresar</button>
        </div>
      </div>
    </div>
  </body>
</html>


