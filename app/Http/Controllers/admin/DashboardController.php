<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;
use App\Models\File;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    protected $page = 'file';
    protected $message = '';
    protected $success = false;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'headers' => $this->headers(),
            'page' => $this->page,
        ];

        return view('admin.file.index', $data);
    }

    public function redirectToSite() {
        $url = 'http://www.sharepeeps.org/advisoryboard';
        return \Redirect::to($url);
    }

    /**
     * This is used to upload file
     *
     * @param Request $request
     */
    public function uploadFile(Request $request)
    {
        $fileName = $request->input('file_name');
        $destinationPath = public_path(uploadFile);
        $file = Input::file('file');
        $fileName = $fileName . '.' . $file->guessExtension();
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $fileName = uniqueFileName($destinationPath, $fileName);
        if (Input::file('file')->move($destinationPath, $fileName)) {
            $objFile = new File();
            $objFile->name = $fileName;
            $objFile->created_by = loginId();
            $objFile->active = 1;
            $objFile->status = 1;
            $objFile->save();
        }

        return redirect()->route('files.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $splitId = explode('_', $id)[1];
        $obj = File::find($splitId);
        $this->message = 'There is problem to delete File';
        if ($obj && $obj->delete()) {
            $this->message = 'File is deleted successfully';
            $this->success = true;
        }

        return response()->json(['success' => $this->success, 'message' => $this->message, 'id' => $splitId]);
    }

    /**
     * This is used to get users list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFiles(Request $request)
    {
        $params = [
            'perPage' => 10,
            'page' =>   $request->input('page'),
            'search' => $request->input('search'),
            'sortColumn' => $request->input('sortColumn'),
            'sortType' => $request->input('sortType'),
        ];
        $data = File::getFiles($params);

        return response()->json($data);
    }

    /**
     * This is used to download a file
     *
     * @param $id
     */
    public function downloadFile($id)
    {
        $baseUrl = \URL::to('/');
        $objFile = File::find($id);
        $attachment = 'attachment';
        if ($objFile) {
            $fileName = $objFile->name;
            if (!empty($fileName)) {
                $fileUrl = $baseUrl . '/' . uploadFile . $fileName;
            }
            downloadFile($fileName, $fileUrl, $attachment);
        }
    }

    /**
     * This is used to return headers
     *
     * @return array
     */
    private function headers() {
        return [
            0 => ['name' => 'File Name', 'sorterKey' => 'f.name', 'isSorter' => true],
            1 => ['name' => 'Uploaded By', 'sorterKey' => 'u.user_name', 'isSorter' => true],
            2 => ['name' => 'Uploaded Date', 'sorterKey' => 'f.created_at', 'isSorter' => true],
            3 => ['name' => 'ACTION', 'isSorter' => false]
        ];
    }
}
