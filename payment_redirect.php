<?php 
session_start();
?>
<form method='POST' action="<?php echo $_POST["payment_method"]==="Swedbank" ? "pay.php":"pay_seb.php"?>"id="form">
    <div class="form-group row">
        <label for="firstname" class="col-sm-2 col-form-label">Eesnimi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname">
        </div>
    </div>
    <div class="form-group row">
        <label for="lastname" class="col-sm-2 col-form-label">Perenimi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Telefon</label>
        <div class="col-sm-10">
            <input type="phone" class="form-control" id="phone" placeholder="Telefoni number">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Vormista tellimus</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    document.getElementById("form").submit(); // SUBMIT FORM
</script>


