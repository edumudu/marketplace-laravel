<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
      $unread = auth()->user()->unreadNotifications;

      return view('admin.notifications', compact('unread'));
    }

    public function readAll()
    {
      $unread = auth()->user()->unreadNotifications;

      $unread->each->markAsRead();

      flash('Norificações lidas com sucesso');

      return redirect()->back();
    }

    public function read($notification)
    {
      $notification = auth()->user()->notifications()->find($notification);
      $notification->markAsRead();

      flash('Norificação lida com sucesso');

      return redirect()->back();
    }
}
