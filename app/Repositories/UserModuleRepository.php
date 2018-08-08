<?php 
namespace App\Repositories;

use DB;
use Excel;
use Auth;
class UserModuleRepository extends UserServiceEloquent{
	public function export(array $tables){
		$datas = array();
		//prepared datas ------------------
		foreach($tables as $table){
			$tempData = DB::table($table)->get();
			array_push($datas,$tempData);
		}
		//$datas =json_decode( json_encode($datas), true);
		//file name according to modules
		$filename = 'User';
		Excel::create($filename, function($excel) use ($datas,$filename,$tables) {
			$sheetNames = $tables;
			$i = 0;
			// loop table to create sheet
			foreach ($datas as $data) {
				$excel->sheet($sheetNames[$i], function($sheet) use($data,$sheetNames) {
					$sheet->fromArray($data);
				});
				$i++;
			}
		})->export('xls');
	}

	public function createUser(array $attributes){
		$attributes['password']=bcrypt($attributes['password']);
		if($attributes['organization_id']==''){
			$attributes['organization_id']=Auth::user()['organization_id'];
		}
		

		return $this->user->create($attributes);
	}
	
	public function getAllRole($limit = null){
		if(isSuperAdmin(Auth::user()['id'])){
			if($limit!=null){
				return $this->role->paginate($limit);
			}
			return $this->role->all();
		}else{
			if($limit!=null){
				return $this->role->where('name','!=','SuperAdmin')->paginate($limit);
			}
			return $this->role->where('name','!=','SuperAdmin')->get();
		}
		
	}
	public function getRoleByUserId($user_id){
	    $roleByUser = DB::table('user_roles')
	               ->join('roles','roles.id','=','user_roles.role_id')
	               ->where('user_roles.user_id','=',$user_id)
	               ->select(
	                  'user_roles.id',
	                  'user_roles.role_id',
	                  'user_roles.user_id',
	                  'roles.name'
	                )
	               ->get();
	    return $roleByUser;
   }

   	public function getRoleByName($name){
		return $this->role->where('name',$name)->first();
	}

	public function checkLastAdminOrNot($userrole_id){

		$admin = $this->getRoleByName('Admin');
		if(count($admin)>0){//id role is admin----
			$userrole = $this->userrole->where('id',$userrole_id)->first();
			$user = $this->user->where('id',$userrole['user_id'])->first();
			$organization_user = DB::table('users')
								->join('user_roles','user_roles.user_id','=','users.id')
								->where('users.organization_id',$user['organization_id'])
								->where('user_roles.role_id',$admin['id'])
								->get();
			if(count($organization_user)==1){
				// id this user is last admin of this organization
				return true;
			}
			return false;	
		}else{
			//id role is not admin----
			return false;
		}
		
	}
   	public function isRoleAssignAlready($user_id,$role_id){
	    $userrole = $this->userrole->where('role_id',$role_id)
	                              ->where('user_id',$user_id)
	                              ->select('*')
	                              ->get();
	    if(count($userrole)>0){
	      return true;
	    }
	    return false;
    }

	public function checkUserHasRole($user_id,$role_id){
	    $userrole = $this->userrole->where('role_id',$role_id)
	                              ->where('user_id',$user_id)
	                              ->select('*')
	                              ->get();
	    if(count($userrole)>0){
	      return true;
	    }
	    return false;
    }

    public function getUserByOrganization($organization_id){
		return $this->user->where('organization_id',$organization_id)->paginate(20);
	}

	public function getRoleIdByName($role){
	  	$role = DB::table('roles')->where('name',$role)->first();
	  	return $role['id'];
	}

	public function isUserHasRole($role,$user_id){
	  	$role = DB::table('roles')->where('name',$role)->first();
	  	$userRole = DB::table('user_roles')->where('user_id',$user_id)->where('role_id',$role['id'])->get();
	  	if(count($userRole)<=0){
	  		return false;
	  	}
	  	return true;
	}


  	public function changePassword(array $attributes){
    	$attributes['password']=bcrypt($attributes['password']);
    	$this->user->findorfail($attributes['user_id'])->update($attributes);
    	return true;
    }
	/*------------------------------------------------------------------------------------
	 this commented code is only for image you can remove it there is not image
	 		------------------------------------------------------------------------------------*/
	/*
	private function uploadImage($file,$width=null,$height=null){
		if($file){
			$extension = $file->getClientOriginalExtension();
			$filename= md5(microtime()).'.'.$extension;
			$destinationPath= 'uploads/image/';
			$file->move($destinationPath,$filename);
			if($width!=null && $height!=null){
				Image::make($destinationPath.$filename)
	            ->resize( $width, $height )//note width x height		
	            ->text('water',100,100,function($font) {
								    //$font->file('foo/bar.ttf');
								    $font->size(200);
								    $font->color(array(255, 255, 255, 0.5));
								    $font->align('center');
								    $font->valign('top');
								    $font->angle(45);
								})
	            ->save($destinationPath.$filename);
	            return $destinationPath.$filename;
			}
			Image::make($destinationPath.$filename)
	            ->resize( 200, 200 )//note width x height		
	            ->text('water',100,100,function($font) {
								    //$font->file('foo/bar.ttf');
								    $font->size(200);
								    $font->color(array(255, 255, 255, 0.5));
								    $font->align('center');
								    $font->valign('top');
								    $font->angle(45);
								})
	            ->save($destinationPath.$filename);    	
		}
		return $destinationPath.$filename;
	}
	*/

	//copy this code in create function----
		/*
		if(array_key_exists('image', $attributes)){
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		*/

	//copy this code in update need some edit ----
		/*
		if(array_key_exists('image', $attributes)){
			$testimonial = $this->testimonial->findorfail($id);
			//delete image
			if($testimonial['image']!='' && file_exists($testimonial['image'])){ 				
				unlink($testimonial['image']);
			}
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		*/

	//copy this code in delete function ----
		/*
		$testimonial = $this->testimonial->findorfail($id);
		//delete image 
		if($testimonial['image']!='' && file_exists($testimonial['image'])){
			unlink($testimonial['image']);
		}
		*/

} 
