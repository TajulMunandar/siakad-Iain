<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Termwind\Components\Dd;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = User::all();
    return view('data_master.user.index')->with(compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'username' => ['required', 'max:16', 'unique:users'],
      'password' => 'required|max:255',
      'isAdmin' => 'required'
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    User::create($validatedData);

    return redirect('/dashboard/data-master/user')->with('success', 'User baru berhasil dibuat!');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    $rules = [
      'name' => 'required|max:255',
      'isAdmin' => 'required'
    ];

    if ($request->username != $user->username) {
      $rules['username'] = ['required', 'max:16', 'unique:users'];
    }

    $validatedData = $request->validate($rules);

    User::where('id', $user->id)->update($validatedData);

    return redirect('/dashboard/data-master/user')->with('success', 'User baru berhasil diperbaharui!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    try {
      User::destroy($user->id);
      return redirect('/dashboard/data-master/user')->with('success', "User $user->name berhasil dihapus!");
    } catch (\Illuminate\Database\QueryException $e) {
      return redirect('/dashboard/data-master/user')->with('failed', "User $user->name tidak bisa dihapus karena sedang digunakan!");
    }
  }

  public function reset(Request $request)
    {
        $rules = [
            'password' => 'required|max:255',
        ];

        if ($request->password == $request->password2) {
            $validatedData = $request->validate($rules);
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::where('id', $request->id)->update($validatedData);
        } else {
            return back()->with('failed', 'Konfirmasi password tidak sesuai');
        }

        return redirect('/dashboard/data-master/user')->with('success', 'Password berhasil direset!');
    }
}
