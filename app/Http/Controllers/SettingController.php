<?php

namespace App\Http\Controllers;

use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Stmt\Echo_;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting =Setting::orderBy('id', 'DESC')->get()->first();
        return view('admin.settings.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Setting::count()==1)
            return redirect()->back();
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=$this->validate($request,[
            'appname'           =>  'required',
            'description'       =>  'required|max:255',
            'address'           =>  'nullable|max:100',
            'facebook'          =>  'nullable|url',
            'instagram'         =>  'nullable|url',
            'whatsapp'          =>  'nullable|numeric|digits:11',
            "mail"              =>  'nullable|email',
            'logo'              =>  'image|mimes:jpeg,png,jpg,gif,svg|max:10240|required',
            "BGshop"            =>'image|mimes:jpeg,png,jpg,gif,svg|max:10240|required',
        ]);
        $data['logo']=request()->file('logo')->store('settings');
        $data['BGshop']=request()->file('BGshop')->store('settings');
        if(Setting::count())
            $setting=Setting::orderBy("id",'desc')->update($data);
        else
            $setting=Setting::create($data);

        session()->flash('status', 'Setting has been Created!');
        return redirect()->route('settings');
    }

    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('admin.settings.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {


        $data=$this->validate($request,[
            'appname'         =>  'required',
            'description'  =>  'required|max:255',
            'address'      =>  'nullable|max:100',
            'facebook'      =>  'nullable|url',
            'instagram'      =>  'nullable|url',
            'whatsapp'      =>  'nullable|numeric|digits:11',
            "mail"  =>  'nullable|email',
            'logo'    =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            "BGshop"=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
        ]);
        $data['logo']=request()->file('logo')->store('settings');
        $data['BGshop']=request()->file('BGshop')->store('settings');
        Storage::delete($setting->logo);
        Storage::delete($setting->BGshop);
        $setting->update($data);
        session()->flash('status', 'Setting has been updated!');
        return redirect()->route('settings');
    }
    public function destroy(Request $request,Setting $setting){
        Storage::delete($setting->logo);
        Storage::delete($setting->BGshop);
        $setting->delete();
        session()->flash('status', 'Setting has been Destroyed!');
        return redirect()->route('settings');

    }
}
