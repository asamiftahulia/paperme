<?php
// Laravel 5.4 Upload Image with Validation example Controllers
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
class ImageUploadController extends Controller
{
    /**
    * Create view file
    *
    * @return void
    */
	// display upload-image page 
    public function getUploadImage()
    {
        return view('upload-image');
    }
    /**
    * Manage Post Request
    *
    * @return void
    */
	// get image from upload-image page 
    public function postUplodeImage(Request $request)
    {
        $this->validate($request, [
			// check validtion for image or file
            'uplode_image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
		// rename image name or file name 
        $getimageName = time().'.'.$request->uplode_image_file->getClientOriginalExtension();
        $request->uplode_image_file->move(public_path('images'), $getimageName);
        return back()
            ->with('success','images Has been You uploaded successfully.')
            ->with('image',$getimageName);
    }

    public function viewImage(Request $request)
    {
        // $images = Image::orderBy('created_at', 'desc')->paginate(8);
        // return view('crud_4.index', compact('images'));
        return view('crud4_index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get'))
            return view('crud_4.form');
        else {
            $rules = [
                'description' => 'required',
            ];
            $this->validate($request, $rules);
            $image = new Image();
            if ($request->hasFile('image')) {
                $dir = 'uploads/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                $fileName = str_random() . '.' . $extension; // rename image
                $request->file('image')->move($dir, $fileName);
                $image->image = $fileName;
            }
            $image->description = $request->description;
            $image->save();
            return redirect('/laravel-crud-image-gallery');
        }
    }

    public function delete($id)
    {
        Image::destroy($id);
        return redirect('/laravel-crud-image-gallery');
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('get'))
            return view('crud_4.form', ['image' => Image::find($id)]);
        else {
            $rules = [
                'description' => 'required',
            ];
            $this->validate($request, $rules);
            $image = Image::find($id);
            if ($request->hasFile('image')) {
                $dir = 'uploads/';
                if ($image->image != '' && File::exists($dir . $image->image))
                    File::delete($dir . $image->image);
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $fileName = str_random() . '.' . $extension;
                $request->file('image')->move($dir, $fileName);
                $image->image = $fileName;
            } elseif ($request->remove == 1 && File::exists('uploads/' . $image->image)) {
                File::delete('uploads/' . $image->post_image);
                $image->image = null;
            }
            $image->description = $request->description;
            $image->save();
            return redirect('/laravel-crud-image-gallery');
        }
    }
}