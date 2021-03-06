<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'content',
        'message',
        'url',
        'check',
        'event_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);

    // }

    public function toUser()
    {
        return $this->belongsTo(User::class);

    }

    public function toEvent()
    {
        return $this->belongsTo('\App\Models\Event', 'event_id', 'id');
    }

    public function reserveJudge($event_id,$notice_id)
    {

        $auth_id = Auth::user()->id;

        // $holder_id = Event::where('id',$event_id)->value('user_id');
        // dd($auth_id);

        $reserve = Reserve::where('user_id',$auth_id)->where('event_id',$event_id)->first();



        if(empty($reserve)){
            $notice = Notice::find($notice_id);

            $reserve = Reserve::where('user_id',$notice->from_user_id)->where('event_id',$event_id)->first();
        }

        if($reserve->step == 1 && $reserve->user_id != $auth_id){

            return 1;

        }elseif($reserve->step == 2){

            return 2;

        }else{

            return 3;
        }

    }



}
