<?php 
namespace App\Repositories;

interface UserServiceRepository {

	function getAllUser();

	function getUserById($id);

	function createUser(array $attributes);

	function updateUser($id, array $attributes);

	function deleteUser($id);

	function getAllRole();

	function getRoleById($id);

	function createRole(array $attributes);

	function updateRole($id, array $attributes);

	function deleteRole($id);

	function getAllUserRole();

	function getUserRoleById($id);

	function createUserRole(array $attributes);

	function updateUserRole($id, array $attributes);

	function deleteUserRole($id);

}
