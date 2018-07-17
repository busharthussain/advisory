<div class="row">
    <div class="col-7">
        <div class="row">
            <div class="form-group col-6">
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name','required' => 'required', 'placeholder' => 'Company Name']) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::text('contact_person', null, ['class' => 'form-control', 'id' => 'contact_person','required' => 'required', 'placeholder' => 'Contact Person']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                {!! Form::text('email', $email, ['class' => 'form-control', 'id' => 'email','required' => 'required', 'placeholder' => 'Email']) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::select('region_id', $regions, null, ['class' => 'form-control', 'id' => 'region_id', 'placeholder' => 'Region']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                {!! Form::text('company_number', null, ['class' => 'form-control', 'id' => 'company_number','required' => 'required', 'placeholder' => 'Company Number']) !!}
            </div>
            <div class="form-group col-6">
                {!! Form::text('company_address', null, ['class' => 'form-control', 'id' => 'company_address', 'placeholder' => 'Company Address']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-6 quaty-btn">
                <label class="">Allow Comunitles:</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button"
                                class="quantity-left-minus btn btn-number"
                                data-type="minus" data-field="">
                          <i class="fa fa-minus" aria-hidden="true"></i>
                        </button>
                    </span>
                    @php
                        $community = null;
                        if(empty($data))
                           $community = 1;
                    @endphp
                    {!! Form::text('communities', $community, ['class' => 'input-number', 'id' => 'communities','required' => 'required', 'min' => 1]) !!}
                    <span class="input-group-btn">
                         <button type="button"
                                 class="quantity-right-plus btn btn-number"
                                 data-type="plus" data-field="">
                             <i class="fa fa-plus" aria-hidden="true"></i>
                         </button>
                     </span>
                </div>
            </div>
            <div class="form-group col-6">
                <div class="switch">
                    <label>
                        Stats
                        {{Form::hidden('is_stat',0)}}
                        {!! Form::checkbox('is_stat', 1, null, ['class' => 'field', 'id' => 'is_stat']) !!}
                            <span class="lever"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

<div class="col-5">
    <div class="photo-box">
        <ul class="photo-list">
            <li id="company-image">
                @if(!empty($data->image))
                    <img src="{!! asset(uploadCompanyThumbNailImage.'/'.$data->image) !!}" alt="Image">
                @else
                    <img src="{!! asset('assets/images/placeholder.png') !!}">
                @endif
            </li>
            <li>
                <div id="drag-and-drop-zone" class="uploader">
                    <div class="uploader myLabel">
                        <input type="file" name="file" id="file" accept="image/*">
                        <span>Browse</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="privacy-doucment-sec">
        <div id="privacy-document">
            @if(!empty($data->privacy_document))
                {!! $data->privacy_document !!}
            @endif
        </div>
        <label>Upload Privacy Document</label>
        <div class="myLabel uploader-pdf">
            <input type="file" name="file" />
            <span>Upload</span>
        </div>
        <div class="btn-sec">
            <button class="btn btn-success">@if(empty($id)) Create @else Update @endif</button>
            <a href="{!! URL::route('super.admin.company') !!}" class="btn btn-success">Cancel</a>
        </div>
    </div>
</div>

</div>