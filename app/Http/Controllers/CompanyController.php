<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('admin.company.index',compact('companies',$companies));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name'=>'required',
            'logo'=>'dimensions:min-width=100,min-height=100',
        ]);
        
        
        if ($request->hasFile('logo')) {
            $image      = $request->file('logo');
            $logo   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();                 
            });
            $img->stream(); // <-- Key point
            
            Storage::disk('local')->put('public/'.$logo, $img, 'public');
            $company = new Company([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logo,
            ]);
            $company->save();
            return redirect('/Companies')->with('success', 'Company saved!');
            }else{
                $company = new Company([
                    'name' => $request->name,
                    'email' => $request->email,
                    'website' => $request->website,
                ]);
                $company->save();
                return redirect('/Companies')->with('success', 'Company saved!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('admin.company.edit',compact('company',$company));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'name'=>'required',
            'logo'=>'dimensions:min-width=100,min-height=100',
        ]);
        
        $company = Company::find($id);
        
        if ($request->hasFile('logo')) {
            $image      = $request->file('logo');
            $logo   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();                 
            });
            $img->stream();
            Storage::disk('local')->put('public/'.$logo, $img, 'public');
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            $company->logo = $logo;
            $company->save();
            return redirect('/Companies')->with('success', 'Company Updated...!!');
            }else{
                $company->name = $request->name;
                $company->email = $request->email;
                $company->website = $request->website;
                $company->save();
                return redirect('/Companies')->with('success', 'Company Updated..!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $company = Company::find($id);
       $company->delete();
       return redirect('/Companies')->with('Deleted', 'Company Deleted..!');
    }
}
