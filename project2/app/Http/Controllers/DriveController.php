<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DriveController extends Controller
{

    public function publicDrive()
    {
        $drive = Drive::where('status' , 'public')->get();
        return view('drive.public' , compact('drive'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $drive = Drive::where('user_id', '=', $user_id)->get();
        return view('drive.index', compact('drive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('drive.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $size = 5 * 1024; // 5 MB in KB

        $request->validate([
            'title' => 'required|string|min:3|max:20',
            'drive' => "mimes:pdf,png,jpeg,jpg|max:{$size}",
            'description' => 'required|string|min:20|max:300',
            'category_id' => 'required|exists:categories,id'
        ]);


        $file = $request->file('drive');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $location = public_path('uploads/');
        $file->move($location, $fileName);


        $drive = new Drive();
        $drive->user_id = auth()->user()->id;
        $drive->title = $request->title;
        $drive->drive = $fileName;
        $drive->description = $request->description;
        $drive->category_id = $request->category_id;
        $drive->save();
        return redirect()->back()->with('done', 'Create Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $drive = DB::table('drivescategory')->where('id', $id)->first();

        return view('drive.show', compact('drive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::all();
        $drive = DB::table('drivescategory')->where('id', '=', $id)->first();
        return view('drive.edit', compact('drive', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $drives = DB::table('drives')->where('id', '=', $id)->first();
        $file = $request->file('drive');
        if ($file == null) {
            $file = $drives->drive;
        } else {

            $fileName = time() . '_' . $file->getClientOriginalName();
            $location = public_path('uploads/');


            if (Storage::exists('uploads/' . $drives->drive)) {
                Storage::delete('uploads/' . $drives->drive);
            }


            $file->move($location, $fileName);
        }


        DB::table('drives')->where('id', '=', $id)->update([
            'title' => $request->title,
            'drive' => ($file == null) ? $drives->drive : $fileName,
            'user_id' => auth()->user()->id,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        return redirect()->back()->with('done', 'Edit Successfuly');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drives = Drive::find($id);
        $file = $drives->drive;
        $file_path = public_path("uploads/$file");
        unlink($file_path);
        DB::table('drives')->where('id', '=', $id)->delete();
        return redirect()->back()->with('done', 'Delete Successfuly');
    }
    public function changeStatus($id)
    {
        $drive = Drive::find($id);
        if ($drive->status == 'public') {
            $drive->status = 'private';
            $drive->save();
            return redirect()->back()->with('done', 'Make File Private Successfully');
        } else {
            $drive->status = 'public';
            $drive->save();
            return redirect()->back()->with('done', 'Make File Public Successfully');
        }
    }
}
