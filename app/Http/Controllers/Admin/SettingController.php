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
use App\Models\EmailTemplates;
use App\Models\Stripe3D;
use App\Models\Stripe;
use App\Models\PaypalExpress;
use App\Models\Paypal;
use App\Models\Message;

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
          if($tab_type == "client_email_template"){
            $data_array = [
              'user_id' => $user->id,
              'client_email_template' => $request->client_email,
              'client_cancel_email_template' => $request->client_cancel_email,
              'company_confirm_email_template' => $request->company_confirm_email,
              'company_cancel_email_template' => $request->company_cancel_email,
              'review_email_template' => $request->review_email
            ];
            if($row_id == 0){
              // New entry
              EmailTemplates::create($data_array);
              return redirect()->route('get_email_template')->with(['success' => 'Email Template Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              EmailTemplates::where('id',$row_id)->update($data_array);
              return redirect()->route('get_email_template')->with(['success' => 'Email Template Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "payment_setting"){
            $data_array = [
              'user_id' => $user->id,
              'live_private_key' => $request->live_private_key,
              'live_public_key' => $request->live_public_key,
              'test_private_key' => $request->test_private_key,
              'test_public_key' => $request->test_public_key,
              'gateway_activation_status' => $request->gateway_activation_status,
              'stripe_testmode_status' => $request->stripe_testmode_status
            ];
            if($row_id == 0){
              // New entry
              Stripe3D::create($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              Stripe3D::where('id',$row_id)->update($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "payment_setting1"){
            $data_array = [
              'user_id' => $user->id,
              'live_private_key' => $request->live_private_key,
              'live_public_key' => $request->live_public_key,
              'test_private_key' => $request->test_private_key,
              'test_public_key' => $request->test_public_key,
              'gateway_activation_status' => $request->gateway_activation_status,
              'stripe_testmode_status' => $request->stripe_testmode_status
            ];
            if($row_id == 0){
              // New entry
              Stripe::create($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              Stripe::where('id',$row_id)->update($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "payment_setting2"){
            $data_array = [
              'user_id' => $user->id,
              'live_email' => $request->live_email,
              'test_email' => $request->test_email,
              'live_url' => $request->live_url,
              'test_url' => $request->test_url,
              'live_private_key' => $request->live_private_key,
              'live_public_key' => $request->live_public_key,
              'test_private_key' => $request->test_private_key,
              'test_public_key' => $request->test_public_key,
              'gateway_activation_status' => $request->gateway_activation_status,
              'testmode_status' => $request->testmode_status
            ];
            if($row_id == 0){
              // New entry
              PaypalExpress::create($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              PaypalExpress::where('id',$row_id)->update($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "payment_setting3"){
            $data_array = [
              'user_id' => $user->id,
              'paypal_email' => $request->paypal_email,
              'paypal_url' => $request->paypal_url,
              'test_url' => $request->test_url,
              'gateway_activation_status' => $request->gateway_activation_status,
              'testmode_status' => $request->testmode_status
            ];
            if($row_id == 0){
              // New entry
              Paypal::create($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              Paypal::where('id',$row_id)->update($data_array);
              return redirect()->route('get_payment_setting_page')->with(['success' => 'Payment Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "message_details"){
            $data_array = [
              'user_id' => $user->id,
              'message_details' => $request->message_details
            ];
            if($row_id == 0){
              // New entry
              Message::create($data_array);
              return redirect()->route('get_sms_setting_page')->with(['success' => 'Payment Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              Message::where('id',$row_id)->update($data_array);
              return redirect()->route('get_sms_setting_page')->with(['success' => 'Payment Settings updated successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Updated',200);
            }
          }
          if($tab_type == "pre_message_details"){
            $data_array = [
              'user_id' => $user->id,
              'pre_message_details' => $request->pre_message_details
            ];
            if($row_id == 0){
              // New entry
              Message::create($data_array);
              return redirect()->route('get_sms_setting_page')->with(['success' => 'Payment Settings added successfully']);
              //return $this->sendSuccess(['form_type'=>'email'],'Email Settings Created',200);
            } else {
              // Update Data
              Message::where('id',$row_id)->update($data_array);
              return redirect()->route('get_sms_setting_page')->with(['success' => 'Payment Settings updated successfully']);
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
      $template_data = EmailTemplates::first();
      return view('admin.settings.emailtemplate')->with([
        'title' =>'Email Template Details',
        "header" => "Config Email Template",
        'template_data' => $template_data
      ]);
    }

    public function getpaymentsettingpage(){
      $payment_settings = Stripe3D::first();
      $payment_setting1 = Stripe::first();
      $payment_setting2 = PaypalExpress::first();
      $payment_setting3 = Paypal::first();
      return view('admin.settings.payment')->with(['title' =>'Payment Gateways',
        "header" => "Please Enter Payment Gateways Details",
        'payment_setting' => $payment_settings,
        'payment_setting1' => $payment_setting1,
        'payment_setting2' => $payment_setting2,
        'payment_setting3' => $payment_setting3
      ]);
    }

    public function getsmssettingpage(){
      $sms_settings = Message::first();
      return view('admin.settings.sms')->with(['title' =>'Edit Rating Details',
        "header" => "Please Enter Rating Details",
        'sms_setting' => $sms_settings
      ]);
    }
}
