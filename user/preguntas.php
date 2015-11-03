<div id="cuestionario">
  <hr>
  <div class="form-group">
    <label for="preg1">Seleccione pregunta #1:</label>
    <div class="">
      <select class="form-control" id="preg1" onchange="cargarRespuestas(1)">
        <?php
          include('../prv/conexion.php');
          $sql = "SELECT * FROM pregunta ORDER BY pregunta ASC";
          mysqli_set_charset($con,"utf8");
          $res = mysqli_query($con,$sql); ?>
          <option value="0" disabled selected>Seleccione...</option> <?php
          while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
            echo '<option value="'.$row['id_pregunta'].'">'.$row['pregunta'].'</option>';
          }
          mysqli_close($con);
        ?>
      </select>
    </div>
    <label for="resp1">Seleccione respuesta esperada:</label>
    <div class="">
      <select class="form-control" id="resp1">
        <option value="0" disabled selected>Seleccione...</option>
      </select>
    </div>
  </div><hr>
  <div class="form-group">
    <label for="preg2">Seleccione pregunta #2:</label>
    <div class="">
      <select class="form-control" id="preg2" onchange="cargarRespuestas(2)">
        <?php
          include('../prv/conexion.php');
          $sql = "SELECT * FROM pregunta ORDER BY pregunta ASC";
          mysqli_set_charset($con,"utf8");
          $res = mysqli_query($con,$sql); ?>
          <option value="0" disabled selected>Seleccione...</option> <?php
          while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
            echo '<option value="'.$row['id_pregunta'].'">'.$row['pregunta'].'</option>';
          }
          mysqli_close($con);
        ?>
      </select>
    </div>
    <label for="resp2">Seleccione respuesta esperada:</label>
    <div class="">
      <select class="form-control" id="resp2">
        <option value="0" disabled selected>Seleccione...</option>
      </select>
    </div>
  </div><hr>
  <div class="form-group">
    <label for="preg3">Seleccione pregunta #3:</label>
    <div class="">
      <select class="form-control" id="preg3" onchange="cargarRespuestas(3)">
        <?php
          include('../prv/conexion.php');
          $sql = "SELECT * FROM pregunta ORDER BY pregunta ASC";
          mysqli_set_charset($con,"utf8");
          $res = mysqli_query($con,$sql); ?>
          <option value="0" disabled selected>Seleccione...</option> <?php
          while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
            echo '<option value="'.$row['id_pregunta'].'">'.$row['pregunta'].'</option>';
          }
          mysqli_close($con);
        ?>
      </select>
    </div>
    <label for="resp3">Seleccione respuesta esperada:</label>
    <div class="">
      <select class="form-control" id="resp3">
        <option value="0" disabled selected>Seleccione...</option>
      </select>
    </div>
  </div><hr>
  <div class="form-group">
    <label for="preg4">Seleccione pregunta #4:</label>
    <div class="">
      <select class="form-control" id="preg4" onchange="cargarRespuestas(4)">
        <?php
          include('../prv/conexion.php');
          $sql = "SELECT * FROM pregunta ORDER BY pregunta ASC";
          mysqli_set_charset($con,"utf8");
          $res = mysqli_query($con,$sql); ?>
          <option value="0" disabled selected>Seleccione...</option> <?php
          while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
            echo '<option value="'.$row['id_pregunta'].'">'.$row['pregunta'].'</option>';
          }
          mysqli_close($con);
        ?>
      </select>
    </div>
    <label for="resp4">Seleccione respuesta esperada:</label>
    <div class="">
      <select class="form-control" id="resp4">
        <option value="0" disabled selected>Seleccione...</option>
      </select>
    </div>
  </div><hr>
  <div class="form-group">
    <label for="preg5">Seleccione pregunta #5:</label>
    <div class="">
      <select class="form-control" id="preg5" onchange="cargarRespuestas(5)">
        <?php
          include('../prv/conexion.php');
          $sql = "SELECT * FROM pregunta ORDER BY pregunta ASC";
          mysqli_set_charset($con,"utf8");
          $res = mysqli_query($con,$sql); ?>
          <option value="0" disabled selected>Seleccione...</option> <?php
          while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
            echo '<option value="'.$row['id_pregunta'].'">'.$row['pregunta'].'</option>';
          }
          mysqli_close($con);
        ?>
      </select>
    </div>
    <label for="resp5">Seleccione respuesta esperada:</label>
    <div class="">
      <select class="form-control" id="resp5">
        <option value="0" disabled selected>Seleccione...</option>
      </select>
    </div>
  </div><hr>
  <div class="form-group">
    <label for="preg6">Seleccione pregunta #6:</label>
    <div class="">
      <select class="form-control" id="preg6" onchange="cargarRespuestas(6)">
        <?php
          include('../prv/conexion.php');
          $sql = "SELECT * FROM pregunta ORDER BY pregunta ASC";
          mysqli_set_charset($con,"utf8");
          $res = mysqli_query($con,$sql); ?>
          <option value="0" disabled selected>Seleccione...</option> <?php
          while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
            echo '<option value="'.$row['id_pregunta'].'">'.$row['pregunta'].'</option>';
          }
          mysqli_close($con);
        ?>
      </select>
    </div>
    <label for="resp6">Seleccione respuesta esperada:</label>
    <div class="">
      <select class="form-control" id="resp6">
        <option value="0" disabled selected>Seleccione...</option>
      </select>
    </div>
  </div><hr>
</div>
