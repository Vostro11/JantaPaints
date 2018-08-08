<?php 
namespace App\Repositories;

use App\Entities\User;
use App\Entities\Role;
use App\Entities\UserRole;

class UserServiceEloquent implements UserServiceRepository{
	protected $user;
	protected $role;
	protected $userrole;

	public function __construct(User $user,Role $role,UserRole $userrole){
		$this->user = $user;
		$this->role = $role;
		$this->userrole = $userrole;
	}
	/*---------------------------------------------------------------
					User related Function
	---------------------------------------------------------------*/
	public function getAllUser($limit = null){
		if($limit!=null){
			return $this->user->paginate($limit);
		}
		return $this->user->all();
	}

	public function getUserById($id){
		return $this->user->findorfail($id);
	}

	public function createUser(array $attributes){
		return $this->user->create($attributes);
	}

	public function updateUser($id,array $attributes){
		return $this->user->findorfail($id)->update($attributes);
	}

	public function deleteUser($id){
		return $this->user->findorfail($id)->delete();
	}

	public function softDeleteUser($id){
		return $this->user->findorfail($id)->update(['status'=>'Deleted']);
	}

	public function getUserByStatus($status,$limit = null){
		if($limit!=null){
			return $this->user->where('status',$status)->paginate($limit);
		}
		return $this->user->where('status',$status)->get();
	}

	/*---------------------------------------------------------------
					Role related Function
	---------------------------------------------------------------*/
	public function getAllRole($limit = null){
		if($limit!=null){
			return $this->role->paginate($limit);
		}
		return $this->role->all();
	}

	public function getRoleById($id){
		return $this->role->findorfail($id);
	}

	public function createRole(array $attributes){
		return $this->role->create($attributes);
	}

	public function updateRole($id,array $attributes){
		return $this->role->findorfail($id)->update($attributes);
	}

	public function deleteRole($id){
		return $this->role->findorfail($id)->delete();
	}

	public function softDeleteRole($id){
		return $this->role->findorfail($id)->update(['status'=>'Deleted']);
	}

	public function getRoleByStatus($status,$limit = null){
		if($limit!=null){
			return $this->role->where('status',$status)->paginate($limit);
		}
		return $this->role->where('status',$status)->get();
	}

	/*---------------------------------------------------------------
					UserRole related Function
	---------------------------------------------------------------*/
	public function getAllUserRole($limit = null){
		if($limit!=null){
			return $this->userrole->paginate($limit);
		}
		return $this->userrole->all();
	}

	public function getUserRoleById($id){
		return $this->userrole->findorfail($id);
	}

	public function createUserRole(array $attributes){
		return $this->userrole->create($attributes);
	}

	public function updateUserRole($id,array $attributes){
		return $this->userrole->findorfail($id)->update($attributes);
	}

	public function deleteUserRole($id){
		return $this->userrole->findorfail($id)->delete();
	}

	public function softDeleteUserRole($id){
		return $this->userrole->findorfail($id)->update(['status'=>'Deleted']);
	}

	public function getUserRoleByStatus($status,$limit = null){
		if($limit!=null){
			return $this->userrole->where('status',$status)->paginate($limit);
		}
		return $this->userrole->where('status',$status)->get();
	}

}