<?php 
    /**
     *  autoload class, which loads all classes with a .php extension into the web-based interface
     *  Authors: Natalie Mulodjanov (1956449), Ron Friedman (1926133), Vanier College 2021
     *  Date: 
     *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
     */ 

    spl_autoload_register(function($class_name){
        // Import all classes with file extensiion .php
        include $class_name . '.php'; 

    }
);
?>