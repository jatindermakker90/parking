<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSetting;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\TwilioSetting;
use App\Models\SiteScriptSetting;
use App\Models\TermCondition;

class SettingController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email_settings = EmailSetting::first();
        $twilio_settings = TwilioSetting::first();
        $script_settings = SiteScriptSetting::first();
        $term_condition_settings = TermCondition::first();
        return view('admin.settings.index')->with([
          'title' =>'Site Settings',
          "header" => "Please enter site settings details",
          'email_setting' => $email_settings,
          'twilio_setting'=> $twilio_settings,
          'script_setting' => $script_settings,
          'term_condition_setting' => $term_condition_settings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $tab_type = $request->form_type;
        $row_id = $request->row_id;
        try{
          if($tab_type == 'email'){
            $data_array = [
              'user_id' => $user->id,
              'smtp2go_api_key' => $request->smtp2go_api_key, 'smtp2go_base_url' => $request->smtp2go_base_url,
              'smtp_host' => $request->smtp_host, 'smtp_username' => $request->smtp_username,
              'smtp_password' => $request->smtp_password, 'smtp_port' => $request->smtp_port,
              'smtp_debug_status' => $request->smtp_debug_status, 'smtp_ssl_status' => $request->smtp_ssl_status,
              'review_smtp_host' => $request->review_smtp_host, 'review_smtp_username' => $request->review_smtp_username,
              'review_smtp_passowrd' => $request->review_smtp_passowrd, 'review_smtp_port' => $request->review_smtp_port,
              'review_smtp_debug_status' => $request->review_smtp_debug_status, 'review_smtp_ssl_status' => $request->review_smtp_ssl_status,
              'from_email_confirmation' => $request->from_email_confirmation, 'from_email_amend' => $request->from_email_amend,
              'from_email_cancel' => $request->from_email_cancel, 'email_cc' => $request->email_cc,
              'email_bcc' => $request->email_bcc, 'contact_email' => $request->contact_email,
              'noreply_confirmation' => $request->noreply_confirmation, 'noreply_amend' => $request->noreply_amend,
              'noreply_cancel' => $request->noreply_cancel, 'default_smtp_gateway' => $request->default_smtp_gateway,
            ];
            if($row_id == 0){
              // New entry
              EmailSetting::create($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Email Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data0
              EmailSetting::where('id',$row_id)->update($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Email Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "twilio"){
            $data_array = [
              'user_id' => $user->id,
              'twilio_acc_id' => $request->twilio_acc_id, 'twilio_auth_token' => $request->twilio_auth_token,
              'twilio_form_number' => $request->twilio_form_number, 'twilio_box' => $request->twilio_box,
            ];
            if($row_id == 0){
              // New entry
              TwilioSetting::create($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Twilio Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              TwilioSetting::where('id',$row_id)->update($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Twilio Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "script"){
            $data_array = [
              'user_id' => $user->id,
              'header_script' => $request->header_script, 'footer_script' => $request->footer_script,
              'body_script' => $request->body_script, 'booking_script' => $request->booking_script,
            ];
            if($row_id == 0){
              // New entry
              SiteScriptSetting::create($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Site Script Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              SiteScriptSetting::where('id',$row_id)->update($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Site Script Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "term"){
            $data_array = [
              'user_id' => $user->id,
              'term_condition_box' => $request->term_condition_box
            ];
            if($row_id == 0){
              // New entry
              TermCondition::create($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Term Condition Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              TermCondition::where('id',$row_id)->update($data_array);
              return redirect()->route('settings.index')->with(['success' => 'Term Condition Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
        } catch (Exception $e) {
            $message = $e->getMessage()." at line ".$e->getLine()." in file ".$e->getFile();
            return $this->sendError($message);
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

    public function getpagelist(){
      return view('admin.settings.pagelist')->with(['title' =>'Page List', "header" => "Config Page"]);
    }

    public function getemailtemplatepage(){
      return view('admin.settings.emailtemplate')->with(['title' =>'Email Template Details', "header" => "Config Email Template"]);
    }

    public function getpaymentsettingpage(){
      return view('admin.settings.payment')->with(['title' =>'Payment Gateways', "header" => "Please Enter Payment Gateways Details"]);
    }
}
