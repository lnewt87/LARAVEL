<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
   if(Auth::guest()){
	   return Redirect::to('login');
	   
   }else
	   return Redirect::to('profile');
	
});
//read an item
Route::get('hello/{name}', function ($name) {
	echo $name;
    echo '<form action="hello" method="post">';
	echo '<input type="submit" value="submit">';
	echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
	echo '<input type="hidden" name="_method" value="put" >';
	echo '</form>';
});
//create an item
Route::post('hello', function () {
    echo 'post! ';
});
//update an item
Route::put('hello', function () {
    echo 'put';
});
//delete an item
Route::delete('hello', function () {
    echo 'delete ';
});
//Route::get('hello123','TestController@index');

Route::get('customers', function()
{
	$customer = App\test::find(1);
	echo 'Hello my name is ' . $customer->name;
	
});

Route::get('register', function () {
	echo '<h1><center>Register</center></h1>';
    echo '<form action="setting" method="post" style="background: lightgray; padding: 15px; width: 250px; margin-right: auto; margin-left: auto;">';
	echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
	echo '<input type="text" name="name" value="name" ><br>';
	echo '<input type="text" name="email" value="email" ><br>';
	echo '<input type="text" name="height" value="height" ><br>';
	echo '<input type="text" name="weight" value="weight" ><br>';
	echo '<input type="hidden" name="_method" value="put" ><br>';
	echo '<input type="password" name="password" value="password" ><br>';
	echo '<input type="submit" value="register">';
	echo '</form>';
});

Route::post('register', function () {
    echo 'post! ';
});



Route::get('login', function () {
	echo '<h1><center>login</center></h1>';
    echo '<form action="login" method="post" style="background: lightgray; padding: 15px; width: 250px; margin-right: auto; margin-left: auto;">';
	
	echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
	echo '<input type="text" name="name" value="name" ><br>';
	echo '<input type="password" name="password" value="password" ><br>';
	echo '<input type="submit" value="submit">';
	echo '</form>';
});
Route::post('login', function () {
    echo 'post! login page';
});


Route::get('profile', function () {
	$name = Auth::user()->name;
	$email = Auth::user()->email;
	$height = Auth::user()->height;
	$weight = Auth::user()->weight;
	$dob = Auth::user()->dob;
	  $hformat = Auth::user()->hformat;
	  $wformat = Auth::user()->wformat;
	  $dformat = Auth::user()->dformat;
	  
	  
	  
	  $hprofile = '';
	  $wprofile = '';
	  $dprofile = 'N/A';
	  
	  
	  if ($hformat == 1){
		  $f = round($height / 30.48) . ' Feet ';
		  
		  $ix = $f * 30.48;
		  $iy = $height - $ix;
		
		  $i = round($iy / 2.54) . ' Inches';
		$hprofile = $f . ' '. $i;		  
	  }else if($hformat == 2){	  
	 $hprofile = $height. ' Centimeters'; 
	  } else
		  $hprofile = "N/A";
	  if ($wformat == 2){
	   $wprofile = round($weight * 0.45) .' Kilograms';}
		 
	  else  if($wformat == 1){
	   $wprofile = round($weight)  .' Pounds';
	  }else
		  $wprofile ="N/A";
   
   
   $day = substr($dob, -2);   
   $year = substr($dob, 0, 4);
   $year2 = substr($dob, 2, 2);
   $month = substr($dob, 5, 2); 
   
   if ($dformat == 'd1'){
	   $dprofile =  $month."/".$day."/".$year2;
	   
   }
 if ($dformat == 'd2'){
	   $dprofile =  $month."/".$day."/".$year;
	   
   }
 if ($dformat == 'd3'){
	   $dprofile =  $day."/".$month."/".$year2;
	   
   }
 if ($dformat == 'd4'){
	   $dprofile =  $day."/".$month."/".$year;
	   
   }

   
  
   
   
	
	   
	  echo '<div style="background: lightgray; padding: 25px; width: 275px; margin-right: auto; margin-left: auto;">';
	echo '<h1>Welcome ' . $name . '</h1>';
	echo '<br>';
	echo '<h2>Height: </h2> '. $hprofile;
	echo '<br>';
	echo '<h2>Weight: </h2> '. $wprofile;
	echo '<br>';
	echo '<h2>Date: </h2> '. $dprofile;
	echo '<br>';
	echo '</div>';
	echo '<br>';
	echo '<div style="background: lightgray; padding: 25px; width: 275px; margin-right: auto; margin-left: auto;">';
	echo '<a href="http://localhost:8000/setting" style="text-decoration: none; color: black; text-align: center; font-size: 13pt; font-weight: bold;">
	CLICK TO CHANGE SETTINGS</a></h1>';
	echo '</div>';
	
	
	
	
});




Route::get('setting', function () {
	echo '<h1><center>Settings Page</center></h1>';

	$name = Auth::user()->name;
	$email = Auth::user()->email;
	$height = Auth::user()->height;
	$weight = Auth::user()->weight;
	$dob = Auth::user()->dob;
	  $hformat = Auth::user()->hformat;
	  $wformat = Auth::user()->wformat;
	  $dformat = Auth::user()->dformat;
	

	
	   echo '<form action="setting2" method="post" style="background: lightgray; padding: 15px; width: 275px; margin-right: auto; margin-left: auto;">';
	   echo '<b>Select height format: </b>';
	   echo'	
<select name="hformat">
  <option value="1" name="hformat">Feet and Inches</option>
  <option value="2" name="hformat">Centimeters</option>
</select>';
echo '<br>';

	
 echo '<b>Select date format: </b>';
 echo'	
<select name="dformat">
  <option value="d1" name="dformat">mm/dd/yy</option>
  <option value="d2" name="dformat">mm/dd/yyyy</option>
   <option value="d3" name="dformat">dd/mm/yy</option>
   <option value="d4" name="dformat">dd/mm/yyyy</option>
</select>'; 
echo '<br>';
 echo '<b>Select weight format: </b>';
 echo'	
<select name="wformat">
  <option value="1" name="wformat">Pounds</option>
  <option value="2" name="wformat">Kilograms</option>
</select>'; 
echo '<br>';	
	
	
	
	
	echo '<b>Height: </b>';
	echo '<input type="number" style="width:50px;"name="height" min="0" value="'. $height.'" required> Centimeters';
	echo '<br>';
	echo '<b>Weight: </b>';
	echo '<input type="number" name="weight" style="width:50px;" min="0" value="'. $weight .'" required> Pounds';
	

	echo '<br>';
	echo '<b>Date of Birth: </b>';
  	echo '<input type="date"  name="dob" width="50" value="'. $dob .'" required>';
	echo '<br>';
	echo '<input type="submit" value="submit">';
	echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
	
	echo '</form>';
	
	
});
use Illuminate\Http\Request;

Route::post('setting2', function(Request $request) {
	  $name2 = $request->input('name');
	   $email2 = $request->input('email');
	    $height2 = $request->input('height');
		 $weight2 = $request->input('weight');
		  $dob2 = $request->input('dob');
		   $hformat2 = $request->input('hformat');
		   $wformat2 = $request->input('wformat');
		   $dformat2 = $request->input('dformat');

	$id = Auth::user()->id;
		DB::table('users')
            ->where('id', $id)
           ->update(array('hformat' => $hformat2, 'wformat' => $wformat2, 'dformat' => $dformat2, 'height' => $height2, 'weight' => $weight2, 'dob' => $dob2));
    	 echo '<div style="background: lightgray; padding: 25px; width: 275px; margin-right: auto; margin-left: auto;">';
	echo '<a href="http://localhost:8000/profile" style="text-decoration: none; color: black; text-align: center; font-size: 13pt; font-weight: bold;">
	<center>SAVED SUCCESSFULLY!<BR>
	CLICK TO RETURN TO PROFILE</center></a>';
	echo '</div>';
	
});













Route::auth();

Route::get('/home', 'HomeController@index');
