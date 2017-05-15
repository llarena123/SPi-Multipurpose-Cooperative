<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function _index(){
    	return view('Admin.upload-excel');
    }

    public function uploadExcel(Request $request){
		$file = $request->file('file');
		$return_data = array(
			'FileName'=>$file->getClientOriginalName(),//FILE NAME
			'FileExtension'=>$file->getClientOriginalExtension(),//FILE EXTENSION
			'FileRealPath'=>$file->getRealPath(),//FILE REAL PATH
			'FileSize'=>$file->getSize(),//FILE TYPE
			'FileMimeType'=>$file->getMimeType()//MIME TYPE
		);

		//Move Uploaded File
		if(!file_exists('excel_uploads')){
			mkdir('excel_uploads');
		}
		$destinationPath = 'excel_uploads';
		if($file->move($destinationPath,$file->getClientOriginalName())){
			return json_encode(array(
                'From' => "SPi Coop Automated System - Upload Controller", 
                'Type' => 'Upload Response', 
                'Return' => true,
                'Message' => 'Upload Success',
                'Data' => $return_data
				)
			);
		}
   }
}
