<?php

namespace Inventario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inventario\Ropa;
use Inventario\Http\Requests\StoreRopaRequest;

class RopaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request)
    {
        if($request->user()!=null){
            $request->user()->authorizeRoles(['user','admin']);
        }else{
            abort(401, 'this action is unauthorized');
        }
        $Ropa = Ropa::all();

        return view('Ropa.index', compact('Ropa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Ropa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRopaRequest $request)
    {
        $ropa = new Ropa();

        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $name = time().$file->getClientOriginalName();
            $ropa->picture = $name;
            $file->move(public_path().'/images/', $name);
        }
        $ropa->name = $request->input('name');
        $ropa->slug = $request->input('slug');
        $ropa->save();

        return redirect()->route('Ropa.index');
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
    public function edit(Ropa $ropa)
    {
        return view('Ropa.edit', compact('ropa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ropa $ropa)
    {
        $ropa->fill($request->except('picture'));
         if($request->hasFile('picture')){
            $file = $request->file('picture');
            $name = time().$file->getClientOriginalName();
            $ropa->picture = $name;
            $file->move(public_path().'/images/', $name);
        }
        $ropa->name = $request->input('name');
        $ropa->save();
        
        return redirect()->route('Ropa.index', [$ropa])->with('status','Ropa actualizada correctament');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ropa $ropa)
    {
            $file_path = public_path().'/images/'.$ropa->picture;
            \File::delete($file_path);

            $ropa->delete();
            return redirect()->route('Ropa.index');
    }
}
