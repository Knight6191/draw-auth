@extends('layouts.app')

@section('page_javascript')
    <script src="/js/profile.js"></script>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href='/main'>Main Application</a> <i class="ace-icon fa fa-angle-double-right"></i> Profile Details</div>

                <div class="panel-body">
                    <div id="user-profile-1" class="user-profile row">
                        <div class="col-xs-12 col-sm-3 center">
                            <div class="profile-picture">
                                @php
                                    $avatar = '/assets/images/avatars/user.png';
                                    if(isset($profile['avatar']) && $profile['avatar'] != ""){
                                        $avatar = \Config::get('app.avatar') . $profile['avatar'];
                                    }
                                @endphp
                                <div class="file-preview" style="background-image: url({{ $avatar }});">
                                    <input type="hidden" name="avatar" class="avatar" value={{$profile['avatar'] or ''}}>
                                </div>
                                <div class="form-upload-file">
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <input type="file" class="file-input-avatar" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-9 form-group">

                            <div class="profile-user-info profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Full Name </div>

                                    <div class="profile-info-value">
                                        <input class="form-control" id="full-name" value="{{$profile['name'] or ''}}" maxlength="255"/>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Phone Number </div>

                                    <div class="profile-info-value">
                                    <input class="form-control input-mask-phone" id="phone-number" value="{{$profile['phone'] or ''}}" maxlength="20"/>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Gender </div>

                                    <div class="profile-info-value">
                                        <select class="form-control" id="gender">
                                            <option value=""></option>
                                            <option value="0" {{$profile['gender']==0?"selected='selected'":""}}>Male</option>
                                            <option value="1" {{$profile['gender']==1?"selected='selected'":""}}>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Birthday </div>

                                    <div class="profile-info-value">
                                        <div class="input-group date" data-provide="datepicker">
                                            <input class="form-control" id="birthday" type="text" value="{{$profile['birthday'] or ''}}" data-date-format="YYYY/mm/dd" maxlength="10">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar bigger-110"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> About Me </div>

                                    <div class="profile-info-value">
                                        <textarea class="form-control" id="about" cols="5" rows="4" maxlength="255">{{$profile['about'] or ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 text-center">
                            <button class="btn btn-lg btn-primary" id="btn-save">
                                <i class="ace-icon fa fa-check"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection