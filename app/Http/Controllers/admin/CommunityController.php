<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Company;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\admin\SharpeepsTrait;
use App\Models\CommunityUser;

class CommunityController extends Controller
{
    use SharpeepsTrait;

    protected $page = 'company';

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
    public function index($id)
    {
        $this->isAdminRole = isAdminRole();
        $companyName = '';
        $obj = Company::find($id);
        if ($obj) {
            $companyName = $obj->name;
            $data = [
                'headers' => $this->headers(),
                'companyId' => $id,
                'page' => $this->page,
                'companyName' => $companyName,
                'allowCommunities' => $obj->communities,
                'totalCommunities' => Community::where('company_id', '=', $id)->count(),
                'isAdminRole' => $this->isAdminRole
            ];

            return view('admin.community.index', $data);
        } else {
            return redirect()->route('super.admin.company');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (isCompanyRole() || isCompanyUserRole()) {
            $this->isCompanyOrUserRole = true;
        }
        $obj = Company::find($id);
        if ($obj) {
            $data = [
                'data' => [],
                'id' => '',
                'companyId' => $id,
                'page' => $this->page,
                'isEdit' => false,
                'viewOnly' => false,
                'isCompanyOrUserRole' => $this->isCompanyOrUserRole
            ];

            return view('admin.community.create', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $data = array();
        parse_str($request->input('data'), $data);
        unset($data['_token']);
        $data['active'] = 1;
        $data['created_by'] = loginId();
        $data['company_id'] = $request->input('company_id');
        $this->message = 'There is problem in creating company';
        $this->success = true;
        $obj = Community::find($id);
        $existingPassword = $obj->password;
        if ($obj->update($data)) {
            if (!empty($data['is_lock']) && $existingPassword != $data['password']) {
                $randomStr = randomPassword(16, 1, 'lower_case') . '_sharepeeps.org';
                $destinationPath = public_path(QRCodePath);
                $fileName = createImageUniqueName('png');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $qrCode = base64_encode($randomStr);
                \QrCode::format('png');
                \QrCode::format('png')->size(500)->generate($qrCode, $destinationPath . '/' . $fileName);
                $obj->qrcode = $randomStr;
                $obj->qrcode_image = $fileName;
                $obj->relative_qrcode_path = QRCodePath;
                $obj->save();
            }

            $this->message = 'Community is added successfully';
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
        if (isCompanyRole() || isCompanyUserRole()) {
            $this->isCompanyOrUserRole = true;
        }
        $viewOnly = $request->input('viewOnly');
        $objCommunity = Community::find($id);
        if ($objCommunity) {
            $data = [
                'data' => $objCommunity,
                'id' => $id,
                'companyId' => $objCommunity->company_id,
                'page' => $this->page,
                'isEdit' => true,
                'viewOnly' => $viewOnly,
                'isCompanyOrUserRole' => $this->isCompanyOrUserRole
            ];

            return view('admin.community.create', $data);
        }
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
        $obj = Community::find($splitId);
        $this->message = 'There is problem to delete company';
        if ($obj && $obj->delete()) {
            $this->message = 'Company is deleted successfully';
            $this->success = true;
        }

        return response()->json(['success' => $this->success, 'message' => $this->message, 'id' => $splitId]);
    }

    /**
     * This is used to upload images
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function uploadFile(Request $request)
    {
        $file = Input::file('file');
        $filePath = '';
        $id = $request->input('id');
        $clickedId = $request->input('clickedId');
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
            $destinationPath = public_path(uploadCommunityThumbNail);
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $img->resize(null, 140, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $fileName);
            $prefix = 'Image';
            $destinationPath = public_path(uploadCommunityImage);
            $filePath = asset(uploadCommunityThumbNail . '/' . $fileName);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            if (Input::file('file')->move($destinationPath, $fileName)) {
                if (empty($id)) {
                    $obj = new Community();
                } else {
                    $obj = Community::find($id);
                }
                if ($clickedId == 'giveaway') {
                    $type = 'give_away_image';
                } else if ($clickedId == 'image') {
                    $type = $clickedId;
                } else {
                $type = $clickedId . '_' . 'image';
            }
            $obj->$type = $fileName;
            $obj->relative_path = uploadCommunityThumbNail;
            $obj->save();
            $id = $obj->id;
            $this->message = $prefix . ' is uploaded successfully';
            $this->success = true;
        }
    }

        return response()->json(['success' => $this->success, 'message' => $this->message, 'fileName' => $filePath, 'clickedId' => $clickedId, 'id' => $id]);
    }

    /**
     * This is used to get companies
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommunities(Request $request)
    {
        $params = [
            'perPage' => 10,
            'page' =>   $request->input('page'),
            'companyId' =>   $request->input('companyId'),
            'search' => $request->input('search'),
            'sortColumn' => $request->input('sortColumn'),
            'sortType' => $request->input('sortType'),
        ];
        $data = Community::getCommunities($params);

        return response()->json($data);
    }

    /**
     * This is used to download file/ force to open file in browser
     *
     * @param $fileName
     * @param $fileUrl
     * @param string $attachment
     *      1) attachment:force download file
     *      2) inline: force open in browser
     */
    public function downloadImage($id)
    {
        $baseUrl = \URL::to('/');
        $objComunity = Community::find($id);
        $attachment = 'attachment';
        if ($objComunity) {
            $fileName = $objComunity->qrcode_image;
            if (!empty($fileName)) {
                $fileUrl = $baseUrl . QRCodePath . '/' . $fileName;
            }
            downloadFile($fileName, $fileUrl, $attachment);
        }
    }

    /**
     * This is used to show join communities
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function joinCommunities(Request $request)
    {
        $this->page = 'joinCommunities';
        $data = [
            'headers' => $this->joinCommunityHeaders(),
        ];

        return view('admin.community.join', $data);
    }

    /**
     * This is used to get join communities
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJoinCommunities(Request $request)
    {
        $params = [
            'perPage' => 10,
            'page' =>   $request->input('page'),
            'search' => $request->input('search'),
            'sortColumn' => $request->input('sortColumn'),
            'sortType' => $request->input('sortType'),
        ];
        $data = Community::getJoinCommunities($params);

        return response()->json($data);
    }

    /**
     * This is used to join/reject community
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinCommunityAction(Request $request)
    {
        $data = explode('_', $request->input('id'));
        $id = $data[1];
        $action = $data[2];
        $objCommunity = CommunityUser::find($id);
        if ($action) {
            $objCommunity->is_allow = 1;
            if ($objCommunity->save()) {
                $this->success = true;
                $this->message = 'Join community request is accepted successfully';
            }
        } else {
            $objCommunity->delete();
            $this->success = true;
            $this->message = 'You have successfully decline a join community request';
        }

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

/**
     * This is used to return headers
     *
     * @return array
     */
    private function headers() {
        return [
            0 => ['name' => 'Community Name', 'sorterKey' => 'title', 'isSorter' => true],
            1 => ['name' => 'Total Post', 'sorterKey' => 'region_name', 'isSorter' => false],
            2 => ['name' => 'Total Users', 'isSorter' => false],
            3 => ['name' => 'QR Code', 'sorterKey' => 'communities', 'isSorter' => false],
            4 => ['name' => 'ACTION', 'isSorter' => false]
        ];
    }

    /**
     * This is used to return headers
     *
     * @return array
     */
    private function joinCommunityHeaders() {
        return [
            0 => ['name' => 'Date', 'sorterKey' => 'created_at', 'isSorter' => true],
            1 => ['name' => 'User Name', 'sorterKey' => 'user_name', 'isSorter' => true],
            2 => ['name' => 'Email', 'sorterKey' => 'email', 'isSorter' => true],
            3 => ['name' => 'Community Name', 'sorterKey' => 'community_name', 'isSorter' => true],
            4 => ['name' => 'ACTION', 'isSorter' => false]
        ];
    }

}
