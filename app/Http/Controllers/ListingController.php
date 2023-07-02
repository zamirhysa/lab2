<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class ListingController 
{
    // shfaq krejt listing
    public function index( ){
         
        return view('listings.index',[
         
            'listings'=> Listing::latest()->filter(request(['tag','search']))->paginate(6)
    
        ]);
    }
    // single listing
    public function show(Listing $listing){
        return view ('listings.show',[
            'listing'=> $listing
        ]);
    }
    //me kriju forme
    public function create(){
        return view ('listings.create');
    }
    //store listing data
    public function store(Request $request){
             
          $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required', Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>['required'],
            'description'=>'required'

          ]);
          if($request->hasFile('logo')){
            $formFields ['logo'] =  $request->file('logo')->store('logos','public');
          }
          $formFields['user_id']=auth()->id();

          Listing::create($formFields);
           
          return redirect('/')->with ('message','Postimi u krye me sukses');

    }
    //edit form
        public function edit (Listing $listing){

          if($listing->user_id != auth()->id()){
            abort(403,'Nuk keni qasje ');
          }
            
            return view ('listings.edit',['listing'=>$listing]);
        }
        public function update(Request $request,Listing $listing){

            // userat logged in jan owner
            if($listing->user_id != auth()->id()){
              abort(403,'Nuk keni qasje ');
            }

            $formFields=$request->validate([
              'title'=>'required',
              'company'=>['required'],
              'location'=>'required',
              'website'=>'required',
              'email'=>['required','email'],
              'tags'=>['required'],
              'description'=>'required'
  
            ]);
            if($request->hasFile('logo')){
              $formFields ['logo'] =  $request->file('logo')->store('logos','public');
            }
  
            $listing->update($formFields);
             
            return back()->with ('message','Postimi u perditesua me sukses');
  
      }
      //delete listing
      public function destroy(Listing $listing){
        // userat logged in jan owner
        if($listing->user_id != auth()->id()){
          abort(403,'Akses i paautorizuar');
        }
        $listing->delete();
        return redirect('/')->with('message','Shpallja u fshi me sukses! ');

      }

      public function manage(Listing $listing){
        return view ('listings.manage',['listings'=>auth()->user()
        ->listings()->get()]);



      }
}
