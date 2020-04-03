<?php
/**
 * Created by PhpStorm.
 * User: jwojdan
 * Date: 17.02.20
 * Time: 16:47
 */
function selectCheck ($string)
{
    $string = strtolower(validate($_POST['input_value']));
    if (startsWith($string, "select")) {
        return $string;
    } else {
        $string = "";
        return $string;
    }
}

?>

<div class="jumbotron text-center">
<h1>Welcome to reports page!</h1>

<p>use predefined scripts or create your own query </p>
<ul id=menu>
    <li><a href=/index.php?p=main>Main page</a>
    <li><a href=/index.php?p=reports>Reports page</a>
    <li><a href=/index.php?p=data_pump>Data Pump page</a>
</ul>
</div>
<div class="container" style="background: #F0F0F0; text-align: center">
    <div class="container" style="background: #F0F0F0;">
        <div class="row align-items-center">
            <div class="col-md" style="padding: 10px">
                <h2>@db_info</h2>
                <p>Displays general information about the database. <br>
                    Requires access to V$ views
                </p>
                <a class="btn btn-secondary" style="font-size: 13px"; href=/index.php?p=db_info_report>execute</a><br><br>

                <h2>@free_space</h2>
                <p>Displays space usage for each datafile. <br>
                    Requires access to DBA_ views
                </p>
                <a class="btn btn-secondary" style="font-size: 13px"; href=/index.php?p=free_space_report>execute</a>
            </div>

            <div class="col-md" >
                <h2>@active_sessions</h2>
                <p>Displays information on all active database sessions. <br>
                    Requires access to V$ views
                </p>
                <a class="btn btn-secondary" style="font-size: 13px"; href=/index.php?p=sessions_report>execute</a><br><br>

                <h2>@directories</h2>
                <p>Displays information about all accessible directories.<br>
                    No requirements
                </p>
                <a class="btn btn-secondary" style="font-size: 13px"; href=/index.php?p=directories_report>execute</a>
            </div>

        </div>
    </div>
</div>
<br>
<div class="container" style="background:  #F0F0F0;">
    <div class="row align-items-center">
        <div class="col-md" style="padding: 10px; text-align: center">
            <h4>to execute your own query: </h4>
            <form class="validated" action="/index.php?p=query" method="POST">
                <textarea name="input_value" rows="10" cols="45" wrap="soft" data-validate="startsWith" data-expected="select"> </textarea><br><br>
                <input type="submit" class="btn btn-secondary" style="font-size: 13px"; name="submit" value="execute query">
            </form>
        </div>
    </div>
</div>
 <br>
 <script   src="https://code.jquery.com/jquery-3.4.1.min.js"   integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="   crossorigin="anonymous"></script>
 <script type="text/javascript">
     $(function(){
         $('form.validated').submit(function(e){
             let inputs = $(this).find('input, textarea');
             inputs.each(function(){
                 let data = $(this).data('validate');
                 let val = $(this).val();
                 let field = $(this).data('field');
                 if(typeof data !== 'undefined'){
                     switch(data){
                         case 'required':
                             if(val.length == 0){
                                 e.preventDefault();
                                 alert('empty field: '+field);
                                 return;
                             }
                             break;
                         case 'startsWith':
                             let expected = $(this).data('expected');
                             if(!val.startsWith(expected)){
                                 e.preventDefault();
                                 alert("must start with "+expected+". select statements only");
                             }
                             break;
                     }
                 }
             });
         });
     });
 </script>



