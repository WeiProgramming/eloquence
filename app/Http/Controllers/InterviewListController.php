<?php

namespace App\Http\Controllers;

use App\UserInterview;
use Illuminate\Http\Request;
use Auth;

class InterviewListController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->user()->userInterview;
    }

    /**
     * Store or edit a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->interview_id == 0){
            if($request->totalInterview == 0){
                $progress = 0;
            }
            else {
                $progress = $this->calculateProgress($request->totalInterview,$request->currentInterview);
            }
            UserInterview::create(array(
                'user_id' => $request->user()->id,
                'company_name' => $request->companyName,
                'position' => $request->position,
                'total_interview' => $request->totalInterview,
                'current_interview' => $request->currentInterview,
                'job_offer' => $request->jobOffer,
                'progress' => $progress
            ));
        }
        else {
            //vue passes in a null for some reason
            if($request->jobOffer == NULL){
                $request->jobOffer = false;
            }
            $userInterview = UserInterview::findOrFail($request->interview_id);
            $userInterview->company_name = $request->companyName;
            $userInterview->position = $request->position;
            $userInterview->current_interview = $request->currentInterview;
            $userInterview->total_interview = $request->totalInterview;
            $userInterview->job_offer = $request->jobOffer;
            $userInterview->progress = $this->calculateProgress($request->totalInterview,$request->currentInterview);

            $userInterview->save();
        }
        return "success";
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $item = UserInterview::destroy($id);
        return "success";
    }

    public function calculateProgress($total,$current){
        //heck against dividing by 0
        return floor(($current/$total)*100);
    }
}
