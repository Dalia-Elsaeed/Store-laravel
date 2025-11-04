<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames('en'),
            'locales' => Languages::getNames('en'),
        ]);
    }
    public function update(Request $request)
    {
        $request->validate(
            [
                'first_name' => ['required', 'string', 'min:3', 'max:255'],
                'last_name' => ['required', 'string', 'min:3', 'max:255'],
                'birthday' => ['nullable', 'date', 'before:today'],
                'gender' => ['in:male,female'],
                'country' => ['required', 'string', 'size:2'],
            ]
        );
        $user = $request->user();
        $user->profile->fill($request->all())->save();
        return redirect()->route('dashboard.profile.edit')->with('success', 'profile updated !!');
    }
}
    //    بص السطر ال فوق دا عوض عن كل ال تحت دا ودا برده فايدة الريلشن
    //    $profile = $user->profile;
    //    if($user->profile){
    //     $profile->update( $request->all());
    //    } else{
        // $request->merge(
        //     [
        //        'user'=>$user,
        //     ]
        //     );
        // Profile::create($request->all());

    //    السطر ال تحت دا عوض عن كل الكومنت ال فوق : ودي فايدة الريلشن
    //    $user->profile->create( $request->all());
    // }}
