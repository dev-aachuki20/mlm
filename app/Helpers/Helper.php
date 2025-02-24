<?php

use Illuminate\Support\Str as Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Uploads;
use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Support\Facades\Mail;
use App\Models\MailContentSetting;
use App\Mail\SendMailContentFromSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

if (!function_exists('convertToFloat')) {
	function convertToFloat($value)
	{
		if (is_numeric($value)) {
			return number_format((float)$value, 2, '.', ' ');
		}
		return $value;
	}
}

if (!function_exists('convertToFloatNotRound')) {
	function convertToFloatNotRound($value)
	{
		if (is_numeric($value)) {
			$dec = 2;
			return number_format(floor($value * pow(10, $dec)) / pow(10, $dec), $dec);
		}
		return $value;
	}
}

if (!function_exists('uploadImage')) {
	/**
	 * Upload Image.
	 *
	 * @param array $input
	 *
	 * @return array $input
	 */
	function uploadImage($directory, $file, $folder, $type="profile", $fileType="jpg",$actionType="save",$uploadId=null,$orientation=null)
	{
		$oldFile = null;
		if($actionType == "save"){
			$upload               		= new Uploads;
		}else{
			$upload               		= Uploads::find($uploadId);
			$oldFile = $upload->file_path;
		}
		$upload->file_path      	= $file->store($folder, 'public');
		$upload->extension      	= $file->getClientOriginalExtension();
		$upload->original_file_name = $file->getClientOriginalName();
		$upload->type 				= $type;
		$upload->file_type 			= $fileType;
		$upload->orientation 		= $orientation;
		$response             		= $directory->uploads()->save($upload);
		// delete old file
		if($oldFile){
			Storage::disk('public')->delete($oldFile);
		}
		return $upload;
	}
}

if (!function_exists('deleteFile')) {
	/**
	 * Destroy Old Image.	 *
	 * @param int $id
	 */
	function deleteFile($upload_id)
	{
		$upload = Uploads::find($upload_id);
		Storage::disk('public')->delete($upload->file_path);
		$upload->delete();
		return true;
	}
}


if (!function_exists('sendEmail')) {
	/**
	 * [sendEmail description]
	 * @return [type]        [description]
	 */
	function sendEmail()
	{
		return true;
	}
}


if (!function_exists('sendResetPasswordEmail')) {
	function sendResetPasswordEmail($user){
		// $token = Str::random(64);

        // DB::table('password_resets')->insert(['email' => $user->email, 'token' => $token, 'created_at' =>  \Carbon\Carbon::now()->toDateTimeString()]);

        // $subject = trans('panel.email_contents.set_password.subject');
        // Mail::to($user->email)->send(new SetPasswordMail($user, $token, $subject));
        // return true;
	}
}


if (!function_exists('CurlPostRequest')) {
	function CurlPostRequest($url,$headers,$postFields)
 	{
 		$curl = curl_init();
	    curl_setopt_array($curl, array(
	           CURLOPT_URL => $url,
	           CURLOPT_RETURNTRANSFER => true,
	           CURLOPT_ENCODING => '',
	           CURLOPT_MAXREDIRS => 10,
	           CURLOPT_TIMEOUT => 0,
	           CURLOPT_FOLLOWLOCATION => true,
	           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	           CURLOPT_CUSTOMREQUEST => 'POST',
	           CURLOPT_POSTFIELDS => $postFields,
	           CURLOPT_HTTPHEADER => $headers,
	    ));
	    $response = curl_exec($curl);
	    curl_close($curl);
	    return json_decode($response);
	}
}

if (!function_exists('CurlGetRequest')) {
	function CurlGetRequest($url,$headers)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => $headers
		));

		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);

	}
}

if (!function_exists('getCommonValidationRuleMsgs')) {
	function getCommonValidationRuleMsgs()
	{
		return [
			'password.required' => 'The new password is required.',
			'password.min' => 'The new password must be at least 8 characters',
			'password.different' => 'The new password and current password must be different.',
			'password.confirmed' => 'The password confirmation does not match.',
			'password_confirmation.required' => 'The new password confirmation is required.',
			'password_confirmation.min' => 'The new password confirmation must be at least 8 characters',
			'email.required' => 'Please enter email address.',
			'email.email' => 'Email is not valid. Enter email address for example test@gmail.com',
		];
	}
}

if (!function_exists('generateRandomString')) {
	function generateRandomString($length = 20) {

		$randomString = Str::random($length);

		return $randomString;
	}
}

if (!function_exists('convertDateTimeFormat')) {
	function convertDateTimeFormat($value,$type='date')
	{
		$changeFormatValue = Carbon::parse($value);

		$result = null;
		switch ($type) {
			case 'time':
				$result = $changeFormatValue->format(config('constants.time_format'));
				break;

			case 'datetime':
				$result = $changeFormatValue->format(config('constants.datetime_format'));
				break;

			case 'monthformat':
				$result = $changeFormatValue->format(config('constants.month_format'));
				break;

			default:
				$result =  $changeFormatValue->format(config('constants.date_format'));
				break;
		}

		return $result;

	}
}

if (!function_exists('getSetting')) {
	function getSetting($key)
	{
		$result = null;
		$setting = Setting::where('key',$key)->where('status',1)->first();
		if($setting){
			if($setting->type == 'image'){
				$result = $setting->image_url;
			}elseif($setting->type == 'video'){
				$result = $setting->video_url;
			}else{
				$result = $setting->value;
			}
		}
		return $result;
	}
}

if (!function_exists('getSettingDisplayName')) {
	function getSettingDisplayName($key)
	{
		$result = null;
		$setting = Setting::where('key',$key)->where('status',1)->first();
		if($setting){
			if($setting->type == 'image'){
				$result = $setting->display_name;
			}elseif($setting->type == 'video'){
				$result = $setting->display_name;
			}else{
				$result = $setting->display_name;
			}
		}
		
		return $result;
	}
}

if (!function_exists('getSettingDetail')) {
	function getSettingDetail($key)
	{
		$setting = Setting::where('key',$key)->where('status',1)->first();
		return $setting;
	}
}

if (!function_exists('getOtherPages')) {
	function getOtherPages()
	{
		$result = Page::where('status',1)->get();
		return $result;
	}
}

if (!function_exists('getDynamicPages')) {
	function getDynamicPages($type)
	{
		$result = Page::where('type',$type)->where('status',1)->get();
		return $result;
	}
}

if (!function_exists('getPageContent')) {
	function getPageContent($slug)
	{
		$result = Page::where('slug',$slug)->where('status',1)->first();
		return $result;
	}
}

if (!function_exists('getFinancialYearMonths')) {
	function getFinancialYearMonths()
	{
		$currentDate = Carbon::now();
		$startYear = $currentDate->month < 4 ? $currentDate->year - 1 : $currentDate->year;
		$startMonth = 4; // Start from April
		$endYear = $currentDate->month < 4 ? $currentDate->year : $currentDate->year + 1;
		$endMonth = 3; // End in March

		$startDate = Carbon::createFromDate($startYear, $startMonth, 1);
		$endDate = Carbon::createFromDate($endYear, $endMonth, 1);

		$months = [];

		while ($startDate->lte($endDate)) {
			$months[] = $startDate->format('F');
			$startDate->addMonth();
		}

		return $months;
	}
}

if (!function_exists('generateUniqueInvoiceNumber')) {
	function generateUniqueInvoiceNumber(){
		return date('YmdHis') . mt_rand(100000, 999999);
	}
}

if (!function_exists('uploadFile')) {
	/**
	 * Upload Image.
	 *
	 * @param array $input
	 *
	 * @return array $input
	 */
	function uploadFile($directory,$tmpFolderPath, $newFolderPath, $type="profile", $fileType="jpg",$actionType="save",$uploadId=null,$orientation=null)
	{
		$saveFilePath = $newFolderPath;

		 // Set the paths for the tmp and new directories
		 $tmpPath = storage_path('app/public/'.$tmpFolderPath);
		 $newPath = storage_path('app/public/'.$newFolderPath);
	 
		// Check if the file exists in the tmp directory
		if (File::exists("{$tmpPath}")) {
			
			if (!File::exists($newPath)) {
				File::makeDirectory($newPath, 0775, true, true);
			}

			$extension = pathinfo($tmpPath, PATHINFO_EXTENSION);

			$timestamp = now()->timestamp;
			$uniqueId = uniqid();

			$fileName = $timestamp . '_' . $uniqueId;

			$newPath .= $fileName.'.'.$extension; 
			$saveFilePath .= $fileName.'.'.$extension;

			// Move the file to the new directory
			File::move("{$tmpPath}", "{$newPath}");
			
			$oldFile = null;
			if($actionType == "save"){
				$upload               		= new Uploads;
			}else{
				$upload               		= Uploads::find($uploadId);
				$oldFile = $upload->file_path;
			}

			$upload->file_path      	= $saveFilePath;
			$upload->extension      	= $extension;
			$upload->original_file_name = null;
			$upload->type 				= $type;
			$upload->file_type 			= $fileType;
			$upload->orientation 		= $orientation;
			$response             		= $directory->uploads()->save($upload);
			// delete old file
			if($oldFile){
				Storage::disk('public')->delete($oldFile);
			}
			
			return $upload;
		}

	}
}

if (!function_exists('removeUploadTmpFolderAndFile')) {
	/**
	 * Upload Image.
	 *
	 * @param array $input
	 *
	 * @return array $input
	 */
	function removeUploadTmpFolderAndFile(){
		//Delete all last week folder
		$lastWeekFolder = now()->subWeek()->format('Y-m-W'); 

		//Image
		$imageFolderPath = public_path("storage/upload/image/{$lastWeekFolder}");

		if (File::exists($imageFolderPath)) {
			File::deleteDirectory($imageFolderPath);
		}

		//Video
		$videoFolderPath = public_path("storage/upload/video/{$lastWeekFolder}");
		if (File::exists($videoFolderPath)) {
			File::deleteDirectory($videoFolderPath);
		}
		//End Delete all last week folder

		return true;
	}

	if (!function_exists('is_active')) {
		function is_active($route) {
			return request()->routeIs($route) ? 'active' : '';
		}
	}

	if (!function_exists('storeSessionData')) {
		function storeSessionData($key, $value)
		{
			Session::put($key, $value);
		}
	}

	if (!function_exists('getSessionData')) {
		function getSessionData($key)
		{
			return Session::get($key);
		}
	}
}
