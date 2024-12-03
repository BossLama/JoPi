<?php

namespace JoPi\App;
class Role
{

    private static array $roles = array();

    private string  $uuid;
    private string  $name;
    private array   $permissions;

    public function __construct(string $uuid, string $name, array $permissions)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->permissions = $permissions;
    }

    // Checks if the Role has a specific permission
    public function hasPermission(string $permission) : bool
    {
        return in_array($permission, $this->permissions);
    }

    // Adds a permission to the Role
    public function addPermission(string $permission)
    {
        $this->permissions[] = $permission;
    }

    // Removes a permission from the Role
    public function removePermission(string $permission)
    {
        $index = array_search($permission, $this->permissions);
        if($index !== false)
        {
            unset($this->permissions[$index]);
        }
    }

    // Getters
    public function getUuid() : string { return $this->uuid;}
    public function getName() : string { return $this->name;}
    public function getPermissions() : array { return $this->permissions;}

    // Creates a new Role object
    public static function create(string $name, array $permissions) : Role
    {
        $uuid = uniqid();
        $role = new Role($uuid, $name, $permissions);
        self::$roles[$uuid] = $role;
        return $role;
    }

    // Returns a Role object by its UUID
    public static function getRole(string $uuid) : Role
    {
        return self::$roles[$uuid];
    }

    // Returns a Role object by its name
    public static function getRoleByName(string $name) : Role
    {
        foreach(self::$roles as $role)
        {
            if($role->name == $name)
            {
                return $role;
            }
        }
        return null;
    }
}
?>