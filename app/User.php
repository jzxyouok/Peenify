<?php

namespace App;

use App\Foundation\Emojiable;
use App\Foundation\Subscribable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Subscribable, Emojiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'facebook_user_id', 'description', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hasBeenCommentByProduct($product_id)
    {
        return $this->comments()->where('product_id', $product_id)->exists();
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function actors()
    {
        return $this->hasMany(Actor::class);
    }

    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function relatedRoles()
    {
        return $this->hasMany(Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function giveRoleTo(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function syncRolesTo(array $roles)
    {
        return $this->roles()->sync($roles);
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }
}
