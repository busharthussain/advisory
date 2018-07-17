<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;
use App\Models\TempImage;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{
    protected $page = 'user';
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
            'isAdminUser' => isAdminUser()
        ];

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!isAdminUser()) {
            return redirect()->route('users.list');
        }
        $data = [
            'data' => [],
            'id' => '',
            'page' => $this->page,
            'isViewOnly' => false
        ];

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isAdminUser()) {
            return redirect()->route('users.list');
        }
        $data = [];
        parse_str($request->input('data'), $data);
        $unique = '';
        $id = $request->input('id');
        $tempImageId = $request->input('tempImageId');
        $passwordValidation = ['password' => 'required|min:6|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+]{1,}$/'];
        if (!empty($id)) {
            $unique = ',' . $id;
            if (empty($data['password']) && empty($data['password_confirmation'])) {
                $passwordValidation = [];
            }
        }
        $validations = [
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'sur_name' => 'required|max:255',
            'mobile_number' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email' . $unique
        ];
        $arrValidation = array_filter(array_merge($validations, $passwordValidation));
        $validator = \Validator::make($data, $arrValidation);

        if ($validator->fails()) {
            $this->message = formatErrors($validator->errors()->toArray());
        } else {
            $data['type'] = 'user';
            if (!empty($data['password'])) {
                $password = $data['password'];
                $data['password'] = bcrypt($data['password']);
            }
            else
                unset($data['password']);

            if (!empty($id)) {
                $obj = User::find($id);
                if ($obj->update($data)) {
                    $this->message = 'User has been updated successfully';
                    $this->success = true;
                }
            } else {
                $obj = User::Create($data);
                if ($obj) {
                    $email = $data['email'];
                    \Mail::send('email/create_user', ['password' => $password, 'name' => $data['name'], 'email' => $data['email']], function ($message) use ($email) {
                        $message->to($email)
                            ->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'))
                            ->subject('Invitation - Sharepeeps Advisory Board®');
                    });
                    $this->message = 'User has been added';
                    $this->success = true;
                }
            }

            if ($this->success && !empty($tempImageId)) {
                $objTempImage = TempImage::find($tempImageId);
                $objUser = User::find($obj->id);
                if ($objUser) {
                    @unlink(userThumbnailFile . '/' . $objUser->image);
                    @unlink(userFile . '/' . $objUser->image);
                }
                $objUser->image = $objTempImage->image;
                $objUser->save();
            }
        }

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $data = [
            'data' => User::find($id),
            'id' => $id,
            'page' => $this->page,
            'isViewOnly' =>  $request->input('viewOnly')
        ];

        return view('admin.user.create', $data);
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
        $obj = User::find($splitId);
        $this->message = 'There is problem to delete User';
        if ($obj && $obj->delete()) {
            $this->message = 'User is deleted successfully';
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
    public function getUsers(Request $request)
    {
        $params = [
            'perPage' => 10,
            'page' =>   $request->input('page'),
            'search' => $request->input('search'),
            'sortColumn' => $request->input('sortColumn'),
            'sortType' => $request->input('sortType'),
        ];
        $data = User::getUsers($params);

        return response()->json($data);
    }

    /**
     * This is used to upload image
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $file = Input::file('file');
        $filePath = '';
        $tempImageId = $request->input('tempImageId');
        $batchId = $request->input('batchId');
        $input = array('file' => $file);
        $rules = array(
            'file' => 'required | mimes:jpeg,jpg,png',
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->toArray();
            $this->message = 'Please Provide valid Image jpeg,jpg,png';
        } else {
            $extension = $file->guessExtension();
            $fileName = createImageUniqueName($extension);

            $img = Image::make($file);
            $destinationPath = public_path(userThumbnailFile);
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $img->resize(null, 140, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $fileName);
            $prefix = 'Image';
            $destinationPath = public_path(userFile);
            $filePath = asset(userThumbnailFile . '/' . $fileName);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            if (Input::file('file')->move($destinationPath, $fileName)) {
                if (empty($tempImageId)) {
                    $obj = new TempImage();
                } else {
                    $obj = TempImage::find($tempImageId);
                    @unlink(userThumbnailFile . '/' . $obj->image);
                    @unlink(userFile . '/' . $obj->image);
                }
                $obj->image = $fileName;
                if ($obj->save()) {
                    $tempImageId = $obj->id;
                    $this->message = 'Image is uploaded successfully';
                    $this->success = true;
                }
            }
        }

        return response()->json(['success' => $this->success, 'message' => $this->message, 'fileName' => $filePath, 'tempImageId' => $tempImageId]);
    }

    /**
     * This is used to return headers
     *
     * @return array
     */
    private function headers() {
        return [
            1 => ['name' => 'Image', 'sorterKey' => 'image', 'isSorter' => false],
            2 => ['name' => 'Name', 'sorterKey' => 'name', 'isSorter' => true],
            3 => ['name' => 'Title', 'sorterKey' => 'title', 'isSorter' => true],
            4 => ['name' => 'Mobile Number', 'sorterKey' => 'mobile_number', 'isSorter' => true],
            5 => ['name' => 'Email', 'sorterKey' => 'email', 'isSorter' => true],
            6 => ['name' => 'ACTION', 'isSorter' => false]
        ];
    }
    
}
