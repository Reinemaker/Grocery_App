<style type="text/css">
   input[id=button]:hover{
         background-color: #37b5c8;
   }
   
</style>
<form action='/Grocery_App/Client_Grocery_App/Account/register' method='post' style="/*margin: 0 auto;*/position: absolute; left: 65%; top: 65%; transform: translate(-195%, -40%); /*border: 5px solid #FFFF00; padding: 10px;*/">
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="First name" type="text" name="first_name" required/>
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Last name" type="text" name="last_name" pattern="^[A-Za-z]*$" title="Last name must only contain letters."/>
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Username" type="text" name="username" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Address" type="text" name="address" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password" type="password" name="password" />
    <input class="form-control" style="width: 250px; margin-right: 10px; margin-bottom: 10px" placeholder="Password confirmation:" type="password" name="password_confirm" />
    <input id="button" style="text-align:center; margin: 0 auto; padding-right: 30px; padding-left: 30px" class="btn btn-success d-flex justify-content-center" type="submit" name="action" value="Register" />
</form>