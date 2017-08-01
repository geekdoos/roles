<?php

namespace LaravelEnso\RoleManager\app\Models;

use App\Owner;
use App\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\DbSyncMigrations\app\Traits\DbSyncMigrations;
use LaravelEnso\Helpers\Traits\FormattedTimestamps;
use LaravelEnso\MenuManager\app\Models\Menu;
use LaravelEnso\PermissionManager\app\Models\Permission;

class Role extends Model
{
    use FormattedTimestamps, DbSyncMigrations;

    protected $fillable = ['name', 'display_name', 'description', 'menu_id'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class)->withTimestamps();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function owners()
    {
        return $this->belongsToMany(Owner::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function getPermissionListAttribute()
    {
        return $this->permissions->pluck('id');
    }

    public function getMenuListAttribute()
    {
        return $this->menus->pluck('id')->toArray();
    }
}
