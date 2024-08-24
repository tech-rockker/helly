<?php

namespace App\Http\Controllers\BackEnd\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UploadFile;
use App\Models\HomePage\CallToActionSection;
use App\Models\Language;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CallToActionController extends Controller
{
  public function index(Request $request)
  {
    $information['info'] = DB::table('basic_settings')->select('call_to_action_section_image')->first();

    $language = Language::query()->where('code', '=', $request->language)->first();
    $information['language'] = $language;

    $information['data'] = $language->callToActionSection()->first();

    $information['langs'] = Language::all();

    return view('backend.home-page.call-to-action-section', $information);
  }

  public function updateImage(Request $request)
  {
    $data = DB::table('basic_settings')->select('call_to_action_section_image')->first();

    $rules = [];

    if (empty($data->call_to_action_section_image)) {
      $rules['call_to_action_section_image'] = 'required';
    }
    if ($request->hasFile('call_to_action_section_image')) {
      $rules['call_to_action_section_image'] = new ImageMimeTypeRule();
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    if ($request->hasFile('call_to_action_section_image')) {
      $newImage = $request->file('call_to_action_section_image');
      $oldImage = $data->call_to_action_section_image;

      $imgName = UploadFile::update(public_path('assets/img/'), $newImage, $oldImage);

      // finally, store the image into db
      DB::table('basic_settings')->updateOrInsert(
        ['uniqid' => 12345],
        ['call_to_action_section_image' => $imgName]
      );

      Session::flash('success', 'Image updated successfully!');
    }

    return redirect()->back();
  }

  public function update(Request $request)
  {
    $language = Language::query()->where('code', '=', $request->language)->first();

    CallToActionSection::query()->updateOrCreate(
      ['language_id' => $language->id],
      [
        'subtitle' => $request->subtitle,
        'title' => $request->title,
        'button_name' => $request->button_name,
        'button_url' => $request->button_url
      ]
    );

    Session::flash('success', 'Call to action section updated successfully!');

    return redirect()->back();
  }
}
