<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::group([
	middleware =>'admin',
	prefix => 'admin'
], function(){
	route::group([] function(){})
 
	
});