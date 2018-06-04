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
    public function index()
    {
        $user = UserInterview::all();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        UserInterview::create(array(
            'user_id' => 1,
            'company_name' => $request->companyName,
            'position' => $request->position,
            'total_interview' => $request->totalInterview,
            'current_interview' => $request->currentInterview,
            'job_offer' => $request->jobOffer,
            'progress' => $this->calculateProgress($request->totalInterview,$request->currentInterview)
        ));

        // $userInterview = new UserInterview;
        // $userInterview->user_id = 1;
        // $userInterview->company_name = $request->companyName;
        // $userInterview->position = $request->position;
        // $userInterview->total_interview = $request->totalInterview;
        // $userInterview->current_interview = $request->currentInterview;
        // $userInterview->job_offer = $request->jobOffer;
        // $userInterview->progress = 60;
        // $userInterview->save();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calculateProgress($total,$current){
        return floor(($current/$total)*100);
    }
}
