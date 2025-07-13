<?php

namespace App\Http\Controllers;

use App\CustomClass\OwnLibrary;
use App\Model\ProfilePicture;
use App\Model\Resume;
use App\Model\Skill;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApplicantController extends Controller
{
    public function profile(Request $request){

        if (!empty($request->get('id'))){
            $applicantId = decrypt($request->get('id'));
        }

        if (!empty($applicantId) && auth()->user()->user_type == 1){
            $user  = User::select('id','first_name','last_name','email')
                ->with('profilePhoto','skills','resume')
                ->find($applicantId);
        }else{
            $user  = User::select('id','first_name','last_name','email')
                ->with('profilePhoto','skills','resume')
                ->find(auth()->id());
        }
        if (!empty($user)){
            return view('applicant.profile',compact('user'));
        }else{
            session()->flash('error','No Information found');
            return redirect()->back();
        }
    }

    public function profileEdit(){
        $id = auth()->id();
        $user  = User::select('id','first_name','last_name','email')
            ->with('profilePhoto','skills')
            ->find($id);

        if ($user){
            return view('applicant.edit',compact('user'));
        }else{
            session()->flash('error','No Information found');
            return redirect()->back();
        }
    }

    public function profileupdate (Request $request){
        $rules = [
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'email' => 'required|max:50|unique:users,email,'.Auth::user()->id.',id',
            'picture' => 'image',
            'path' => 'mimes:doc,docx,pdf',
        ];

        $message = [
            'picture.image' => 'Profile Photo only allow jpg,jpeg and png.',
            'path.mimes' => 'You can only upload word and pdf file as a resume.'
        ];

        $validation = Validator::make($request->all(),$rules,$message);

        if ($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }else{
           $user = User::find(auth()->id());
           $user->first_name = $request->first_name;
           $user->last_name = $request->last_name;
           $user->email = $request->email;

           if ($user->save()){
               $user->skills()->delete();
               if(!empty($request->skill_name) && count($request->skill_name) > 0){
                   for ($i = 0; count($request->skill_name) > $i; $i++) {
                       if (!empty($request->skill_name[$i]) && !empty($request->skill_value[$i])) {
                           $skill = new Skill();
                           $skill->user_id = auth()->id();
                           $skill->skill_name = $request->skill_name[$i];
                           $skill->skill_value = $request->skill_value[$i];
                           $skill->save();
                       }
                   }
               }

               if ($request->picture) {
                   $pPicture = ProfilePicture::where('user_id',auth()->id())->first();
                   if ($pPicture){
                       @unlink($pPicture->picture);
                   }else{
                       $pPicture = new ProfilePicture();
                       $pPicture->user_id = auth()->id();
                   }
                   $uploadFile = OwnLibrary::uploadFile($request->picture, "profile-pic");
                   $pPicture->picture = $uploadFile;
                   $pPicture->save();
               }

               if ($request->path) {
                   $resume = Resume::where('user_id',auth()->id())->first();
                   if ($resume){
                       @unlink($resume->path);
                   }else{
                       $resume = new Resume();
                       $resume->user_id = auth()->id();
                   }
                   $uploadFile = OwnLibrary::uploadFile($request->path, "resume");
                   $resume->path = $uploadFile;
                   $resume->save();
               }

               session()->flash('success','Profile updated');
               return redirect()->route('profile');
           }else{
            session()->flash('error','Unable to update profile.Please try again');
            return redirect()->back()->withInput();
           }
        }
    }
}
