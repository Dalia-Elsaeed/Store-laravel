<?php
function checkLogin(){
    if(isset($_SESSION["user"]))
        return true;
    return false;
};