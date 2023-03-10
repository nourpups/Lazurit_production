<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function delete($id)
  {
   $user = User::find($id)->delete();
    if($user)
    {
        return redirect()->back()->with('fail', 'Can\'t delete user');
    }
        return redirect()->back()->with('success', 'user succesfully deleted');
  }
}

