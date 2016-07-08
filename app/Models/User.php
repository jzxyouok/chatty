<?php

namespace Chatty\Models;

use Illuminate\Database\Eloquent\Model;
use Chatty\Models\Status;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

    use Authenticatable;

    /* The database table used by the model */

    protected $table = 'users';

    /* The attributes theat are fillable using the app */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* return the user's name if available or return null */

    public function getName() {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    /* return the user's full name if available of return the username */

    public function getNameOrUsername() {
        return $this->getName() ? : $this->username;
    }

    public function getFirstNameOrUsername() {
        return $this->first_name ? : $this->username;
    }

    /* Relationships between users */

    public function friendsOfMine() {
        return $this->belongsToMany('Chatty\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf() {
        return $this->belongsToMany('Chatty\Models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequest() {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestPending() {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user) {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user) {
        return (bool) $this->friendRequest()->where('id', $user->id)->count();
    }

    public function addFriend(User $user) {
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriendRequest(User $user) {
        $this->friendRequest()->where('id', $user->id)->first()->pivot->update([
                'accepted' => true,
            ]);
    }

    public function isFriendsWith(User $user) {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    /* Relationship between status and user */
    public function statuses() {
        return $this->hasMany('Chatty\Models\Status', 'user_id');
    }

    /* return the display picture */
    public function displayPicture() {
        return $this->hasOne('Chatty\Models\DisplayPicture', 'user_id');
    }

    public function likes() {
        return $this->hasMany('Chatty\Models\Like', 'user_id');
    }

    /* check if a user has already liked a status */
    public function hasLikedStatus(Status $status) {
        return (bool) $status->likes->where('user_id', $this->id)->count();
    } 

}
